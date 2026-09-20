<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\InquiryService;
use App\Http\Requests\StoreContactMessageRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __construct(
        protected InquiryService $inquiryService
    ) {}

    public function index(): View
    {
        return view('public.contact.index');
    }

    public function store(StoreContactMessageRequest $request): RedirectResponse
    {
        $contactMessage = $this->inquiryService->createContactMessage($request->validated());
        $ref = 'EMT-' . strtoupper(substr(uniqid(), -6));

        return redirect()
            ->back()
            ->with('contact_success_modal', true)
            ->with('contact_reference', $ref)
            ->with('contact_name', $request->input('name'))
            ->with('contact_service', $request->input('service', 'General Inquiry'))
            ->with('contact_phone', $request->input('phone'))
            ->with('success', 'Thank you for contacting Emisha Tours & Travels! Our team has received your message and will respond promptly.');
    }
}
