<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer(['layouts.admin', 'admin.*'], function ($view) {
            try {
                $counts = [
                    'pending_visa' => \App\Models\VisaApplication::whereIn('status', ['received', 'under_review'])->count(),
                    'pending_inquiries' => \App\Models\TourInquiry::where('status', 'new')->count(),
                    'pending_tickets' => \App\Models\TicketRequest::where('status', 'pending')->count(),
                    'unread_messages' => \App\Models\ContactMessage::where('status', 'unread')->count(),
                ];
            } catch (\Throwable $e) {
                $counts = [
                    'pending_visa' => 0,
                    'pending_inquiries' => 0,
                    'pending_tickets' => 0,
                    'unread_messages' => 0,
                ];
            }
            $view->with('adminCounts', $counts);
        });
    }
}
