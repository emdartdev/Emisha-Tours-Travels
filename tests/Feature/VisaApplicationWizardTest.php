<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\VisaCountry;
use App\Models\VisaType;
use App\Models\ProfessionType;
use App\Models\VisaApplication;
use App\Models\VisaDocument;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class VisaApplicationWizardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        Storage::fake('visa_private');
    }

    public function test_visa_application_wizard_renders_with_country_and_professions(): void
    {
        $response = $this->get('/visa/apply');

        $response->assertStatus(200);
        $response->assertSee('Tourist Visa Application Portal');
        $response->assertSee('Select Destination');
    }

    public function test_visa_application_submits_successfully_with_private_documents(): void
    {
        $country = VisaCountry::active()->first();
        $visaType = $country->visaTypes()->first();
        $profession = ProfessionType::first();

        $passportScan = UploadedFile::fake()->create('passport_bio.pdf', 800, 'application/pdf');
        $photo = UploadedFile::fake()->create('passport_photo.jpg', 600, 'image/jpeg');
        $bankStatement = UploadedFile::fake()->create('bank_statement_6m.pdf', 1500, 'application/pdf');

        $payload = [
            'visa_country_id' => $country->id,
            'visa_type_id' => $visaType->id,
            'profession_type_id' => $profession->id,
            'full_name' => 'KAZI TANVIR HASAN',
            'email' => 'tanvir.hasan@example.com',
            'phone' => '+8801712000000',
            'date_of_birth' => '1992-05-14',
            'nationality' => 'Bangladeshi',
            'passport_number' => 'A09876543',
            'travel_purpose' => 'Tourism & Leisure',
            'travel_date' => date('Y-m-d', strtotime('+30 days')),
            'stay_duration' => '10 Days',
            'travelers_count' => 1,
            'passport_scan' => $passportScan,
            'photograph' => $photo,
            'bank_statement' => $bankStatement,
        ];

        $response = $this->post('/visa/apply', $payload);

        $application = VisaApplication::where('email', 'tanvir.hasan@example.com')->first();
        $this->assertNotNull($application);
        $response->assertRedirect('/visa/track/' . $application->reference_number);
        $response->assertSessionHas('success');

        // Verify Application created in Database
        $this->assertDatabaseHas('visa_applications', [
            'email' => 'tanvir.hasan@example.com',
            'full_name' => 'KAZI TANVIR HASAN',
            'passport_number' => 'A09876543',
            'status' => 'received',
        ]);

        $this->assertMatchesRegularExpression('/^VISA-\d{4}-\d{6}$/', $application->reference_number);

        // Verify Attached Documents
        $documents = VisaDocument::where('visa_application_id', $application->id)->get();
        $this->assertCount(3, $documents);

        foreach ($documents as $doc) {
            Storage::disk('visa_private')->assertExists($doc->storage_path);
            $this->assertEquals('uploaded', $doc->status);
        }
    }

    public function test_visa_application_validation_rules(): void
    {
        $response = $this->post('/visa/apply', [
            // Missing required fields
            'email' => 'invalid-email',
        ]);

        $response->assertSessionHasErrors([
            'visa_country_id',
            'visa_type_id',
            'full_name',
            'email',
            'phone',
        ]);
    }

    public function test_visa_application_file_size_and_mime_validation(): void
    {
        $country = VisaCountry::active()->first();
        $visaType = $country->visaTypes()->first();

        // Invalid file format (.exe)
        $invalidFile = UploadedFile::fake()->create('malicious.exe', 500, 'application/x-msdownload');

        $response = $this->post('/visa/apply', [
            'visa_country_id' => $country->id,
            'visa_type_id' => $visaType->id,
            'full_name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '+8801700000000',
            'passport_scan' => $invalidFile,
        ]);

        $response->assertSessionHasErrors(['passport_scan']);
    }
}
