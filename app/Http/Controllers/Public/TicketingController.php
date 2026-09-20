<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\TicketRequestService;
use App\Http\Requests\StoreTicketRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TicketingController extends Controller
{
    public function __construct(
        protected TicketRequestService $ticketService
    ) {}

    public function index(): View
    {
        return view('public.ticketing.index');
    }

    public function store(StoreTicketRequest $request): RedirectResponse
    {
        $ticket = $this->ticketService->createTicketRequest($request->validated());

        return redirect()
            ->back()
            ->with('ticket_success_modal', true)
            ->with('ticket_reference', $ticket->reference_number)
            ->with('ticket_passenger', $ticket->full_name)
            ->with('ticket_route', "{$ticket->origin} → {$ticket->destination}")
            ->with('ticket_trip_type', ucfirst($ticket->trip_type ?? 'Round-trip'))
            ->with('ticket_departure_date', $ticket->departure_date)
            ->with('ticket_return_date', $ticket->return_date)
            ->with('ticket_passengers_count', ((int)($ticket->adults ?? 1) + (int)($ticket->children ?? 0) + (int)($ticket->infants ?? 0)))
            ->with('ticket_cabin_class', $ticket->cabin_class ?? 'Economy')
            ->with('ticket_phone', $ticket->phone)
            ->with('success', "Your Air Ticket quotation request for {$ticket->origin} to {$ticket->destination} has been received! Reference: {$ticket->reference_number}. Our ticketing desk will send you competitive fare options.");
    }
}
