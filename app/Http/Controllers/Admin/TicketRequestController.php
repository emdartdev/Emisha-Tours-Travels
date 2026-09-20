<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TicketRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TicketRequestController extends Controller
{
    public function index(Request $request): View
    {
        $query = TicketRequest::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('trip_type')) {
            $query->where('trip_type', $request->trip_type);
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('reference_number', 'like', "%{$term}%")
                  ->orWhere('full_name', 'like', "%{$term}%")
                  ->orWhere('email', 'like', "%{$term}%")
                  ->orWhere('phone', 'like', "%{$term}%")
                  ->orWhere('origin', 'like', "%{$term}%")
                  ->orWhere('destination', 'like', "%{$term}%");
            });
        }

        $tickets = $query->latest()->paginate(15)->withQueryString();

        return view('admin.tickets.index', compact('tickets'));
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:pending,quoted,issued,cancelled'],
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $ticket = TicketRequest::findOrFail($id);
        $ticket->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes ?? $ticket->admin_notes,
        ]);

        return redirect()->back()->with('success', "Ticket Request {$ticket->reference_number} marked as: " . strtoupper($request->status));
    }
}
