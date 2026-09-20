<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\VisaCountry;
use App\Models\VisaApplication;
use App\Models\TourInquiry;
use App\Models\TicketRequest;
use App\Models\ContactMessage;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_tours' => Tour::count(),
            'active_tours' => Tour::published()->count(),
            'total_destinations' => Destination::active()->count(),
            'total_visa_countries' => VisaCountry::active()->count(),
            'pending_visa_applications' => VisaApplication::whereIn('status', ['received', 'under_review'])->count(),
            'total_visa_applications' => VisaApplication::count(),
            'pending_inquiries' => TourInquiry::where('status', 'new')->count(),
            'total_inquiries' => TourInquiry::count(),
            'pending_ticket_requests' => TicketRequest::where('status', 'pending')->count(),
            'total_ticket_requests' => TicketRequest::count(),
            'unread_messages' => ContactMessage::where('status', 'unread')->count(),
        ];

        $recentVisaApplications = VisaApplication::with(['country', 'visaType'])
            ->latest('submitted_at')
            ->limit(5)
            ->get();

        $recentInquiries = TourInquiry::with(['tour'])
            ->latest()
            ->limit(5)
            ->get();

        $recentTicketRequests = TicketRequest::latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentVisaApplications',
            'recentInquiries',
            'recentTicketRequests'
        ));
    }
}
