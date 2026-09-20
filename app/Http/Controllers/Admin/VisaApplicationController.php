<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisaApplication;
use App\Models\VisaDocument;
use App\Models\VisaCountry;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\View\View;

class VisaApplicationController extends Controller
{
    public function index(Request $request): View
    {
        $query = VisaApplication::with(['country', 'visaType', 'profession', 'documents']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('country_id')) {
            $query->where('visa_country_id', $request->country_id);
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('reference_number', 'like', "%{$term}%")
                  ->orWhere('full_name', 'like', "%{$term}%")
                  ->orWhere('email', 'like', "%{$term}%")
                  ->orWhere('phone', 'like', "%{$term}%")
                  ->orWhere('passport_number', 'like', "%{$term}%");
            });
        }

        $applications = $query->latest('submitted_at')->paginate(15)->withQueryString();
        $countries = VisaCountry::orderBy('country_name', 'asc')->get();

        return view('admin.visa.applications', compact('applications', 'countries'));
    }

    public function show(int $id): View
    {
        $application = VisaApplication::with(['country', 'visaType', 'profession', 'documents'])
            ->findOrFail($id);

        return view('admin.visa.show', compact('application'));
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:received,draft,under_review,documents_required,embassy_submitted,submitted,processing,approved,completed,rejected,cancelled'],
            'admin_notes' => ['nullable', 'string', 'max:1000'],
            'applicant_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $application = VisaApplication::findOrFail($id);
        $application->update([
            'status' => $request->status,
            'admin_notes' => $request->filled('admin_notes') ? $request->admin_notes : $application->admin_notes,
            'applicant_notes' => $request->filled('applicant_notes') ? $request->applicant_notes : $application->applicant_notes,
            'processed_at' => in_array($request->status, ['approved', 'rejected', 'completed']) ? now() : $application->processed_at,
        ]);

        return redirect()->back()->with('success', "Visa Application {$application->reference_number} status updated to: " . strtoupper(str_replace('_', ' ', $request->status)));
    }

    public function updateDocumentStatus(Request $request, int $applicationId, int $documentId): RedirectResponse
    {
        $request->validate([
            'review_status' => ['required', 'in:uploaded,approved,needs_replacement,rejected'],
            'review_note' => ['nullable', 'string', 'max:500'],
        ]);

        $application = VisaApplication::findOrFail($applicationId);
        $document = VisaDocument::where('visa_application_id', $application->id)
            ->where('id', $documentId)
            ->firstOrFail();

        $document->update([
            'review_status' => $request->review_status,
            'review_note' => $request->review_note,
        ]);

        return redirect()->back()->with('success', "Document [{$document->original_filename}] marked as " . strtoupper($request->review_status));
    }

    public function downloadDocument(int $applicationId, int $documentId): StreamedResponse
    {
        $application = VisaApplication::findOrFail($applicationId);
        $document = VisaDocument::where('visa_application_id', $application->id)
            ->where('id', $documentId)
            ->firstOrFail();

        if (!Storage::disk('visa_private')->exists($document->storage_path)) {
            abort(404, 'The requested document file could not be found in private storage.');
        }

        return Storage::disk('visa_private')->download(
            $document->storage_path,
            $document->original_filename,
            ['Content-Type' => $document->mime_type]
        );
    }
}
