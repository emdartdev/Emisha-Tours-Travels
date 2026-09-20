<?php

namespace App\Services;

use App\Models\TourInquiry;
use App\Models\ContactMessage;
use App\Support\ReferenceGenerator;
use Illuminate\Support\Facades\DB;

class InquiryService
{
    /**
     * Create a new tour inquiry with reference number.
     */
    public function createTourInquiry(array $data): TourInquiry
    {
        return DB::transaction(function () use ($data) {
            $refNumber = ReferenceGenerator::forTourInquiry();

            return TourInquiry::create([
                'reference_number' => $refNumber,
                'tour_id' => $data['tour_id'] ?? null,
                'tour_title' => $data['tour_title'] ?? null,
                'full_name' => $data['full_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'travel_date' => $data['travel_date'] ?? null,
                'adults' => $data['adults'] ?? 1,
                'children' => $data['children'] ?? 0,
                'message' => $data['message'] ?? null,
                'status' => 'new',
            ]);
        });
    }

    /**
     * Create a general contact message.
     */
    public function createContactMessage(array $data): ContactMessage
    {
        return ContactMessage::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'service' => $data['service'] ?? 'General Inquiry',
            'travel_date' => $data['travel_date'] ?? null,
            'message' => $data['message'],
            'status' => 'unread',
        ]);
    }
}
