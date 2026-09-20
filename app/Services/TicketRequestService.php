<?php

namespace App\Services;

use App\Models\TicketRequest;
use App\Support\ReferenceGenerator;
use Illuminate\Support\Facades\DB;

class TicketRequestService
{
    /**
     * Create an air ticketing request with reference number.
     */
    public function createTicketRequest(array $data): TicketRequest
    {
        return DB::transaction(function () use ($data) {
            $refNumber = ReferenceGenerator::forTicketRequest();

            return TicketRequest::create([
                'reference_number' => $refNumber,
                'trip_type' => $data['trip_type'] ?? 'round-trip',
                'origin' => $data['origin'],
                'destination' => $data['destination'],
                'departure_date' => $data['departure_date'],
                'return_date' => $data['return_date'] ?? null,
                'adults' => $data['adults'] ?? 1,
                'children' => $data['children'] ?? 0,
                'infants' => $data['infants'] ?? 0,
                'cabin_class' => $data['cabin_class'] ?? 'Economy',
                'preferred_airline' => $data['preferred_airline'] ?? null,
                'additional_requirements' => $data['additional_requirements'] ?? null,
                'full_name' => $data['full_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'status' => 'new',
            ]);
        });
    }
}
