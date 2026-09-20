<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourInquiry;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InquiryController extends Controller
{
    public function index(Request $request): View
    {
        $query = TourInquiry::with(['tour']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('reference_number', 'like', "%{$term}%")
                  ->orWhere('full_name', 'like', "%{$term}%")
                  ->orWhere('email', 'like', "%{$term}%")
                  ->orWhere('phone', 'like', "%{$term}%");
            });
        }

        $inquiries = $query->latest()->paginate(15)->withQueryString();

        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:new,in_progress,quoted,booked,cancelled'],
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $inquiry = TourInquiry::findOrFail($id);
        $inquiry->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes ?? $inquiry->admin_notes,
        ]);

        return redirect()->back()->with('success', "Inquiry {$inquiry->reference_number} marked as: " . strtoupper($request->status));
    }
}
