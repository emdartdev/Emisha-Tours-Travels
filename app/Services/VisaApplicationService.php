<?php

namespace App\Services;

use App\Models\VisaApplication;
use App\Models\VisaDocument;
use App\Support\ReferenceGenerator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VisaApplicationService
{
    /**
     * Submit a multi-step visa application with private file uploads.
     */
    public function submitApplication(array $data, array $uploadedFiles = []): VisaApplication
    {
        return DB::transaction(function () use ($data, $uploadedFiles) {
            $refNumber = ReferenceGenerator::forVisaApplication();

            $application = VisaApplication::create([
                'reference_number' => $refNumber,
                'visa_country_id' => $data['visa_country_id'],
                'visa_type_id' => $data['visa_type_id'],
                'profession_type_id' => $data['profession_type_id'] ?? null,
                'full_name' => $data['full_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'date_of_birth' => $data['date_of_birth'] ?? null,
                'nationality' => $data['nationality'] ?? 'Bangladeshi',
                'passport_number' => $data['passport_number'] ?? null,
                'travel_purpose' => $data['travel_purpose'] ?? 'Tourism',
                'travel_date' => $data['travel_date'] ?? null,
                'stay_duration' => $data['stay_duration'] ?? null,
                'travelers_count' => $data['travelers_count'] ?? 1,
                'status' => 'received',
                'submitted_at' => now(),
            ]);

            // Process confidential documents into private disk
            foreach ($uploadedFiles as $docType => $file) {
                if ($file instanceof UploadedFile && $file->isValid()) {
                    $this->attachDocument($application, $file, $docType);
                } elseif (is_array($file)) {
                    foreach ($file as $subFile) {
                        if ($subFile instanceof UploadedFile && $subFile->isValid()) {
                            $this->attachDocument($application, $subFile, $docType);
                        }
                    }
                }
            }

            return $application;
        });
    }

    /**
     * Store single document securely in private storage.
     */
    public function attachDocument(VisaApplication $application, UploadedFile $file, string $docType): VisaDocument
    {
        $origName = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $storedName = Str::uuid()->toString() . '.' . $ext;
        $yearMonth = date('Y/m');
        $storageDir = "applications/{$yearMonth}";

        // Store to private visa disk
        $path = $file->storeAs($storageDir, $storedName, 'visa_private');

        return VisaDocument::create([
            'visa_application_id' => $application->id,
            'document_type' => $docType,
            'original_filename' => $origName,
            'stored_filename' => $storedName,
            'mime_type' => $file->getClientMimeType() ?: 'application/octet-stream',
            'file_size' => $file->getSize(),
            'storage_path' => $path,
            'status' => 'uploaded',
            'uploaded_at' => now(),
        ]);
    }
}
