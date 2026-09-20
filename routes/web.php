<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\TourController;
use App\Http\Controllers\Public\DestinationController;
use App\Http\Controllers\Public\VisaController;
use App\Http\Controllers\Public\TicketingController;
use App\Http\Controllers\Public\BlogController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\FaqController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\PageController;
use App\Http\Controllers\Public\SitemapController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/sitemap.xml', [SitemapController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

// Tours
Route::get('/tours', [TourController::class, 'index'])->name('tours.index');
Route::get('/tours/{slug}', [TourController::class, 'show'])->name('tours.show');
Route::post('/tours/{slug}/inquire', [TourController::class, 'inquire'])->middleware('throttle:15,1')->name('tours.inquire');

// Destinations
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{slug}', [DestinationController::class, 'show'])->name('destinations.show');

// Visa
Route::get('/visa', [VisaController::class, 'index'])->name('visa.index');
Route::get('/visa/apply', [VisaController::class, 'apply'])->name('visa.apply');
Route::get('/visa/{slug}/apply', [VisaController::class, 'apply'])->name('visa.apply.slug');
Route::post('/visa/apply', [VisaController::class, 'storeApplication'])->middleware('throttle:20,1')->name('visa.apply.store');
Route::get('/visa/track', [VisaController::class, 'track'])->name('visa.track');
Route::get('/visa/track/{reference}', [VisaController::class, 'track'])->name('visa.track.reference');
Route::post('/visa/onboarding/save-draft', [VisaController::class, 'saveDraft'])->name('visa.onboarding.draft');
Route::get('/visa/onboarding/checklist', [VisaController::class, 'getDestinationChecklist'])->name('visa.onboarding.checklist');
Route::get('/visa/onboarding/upload-quota', [VisaController::class, 'checkUploadQuota'])->name('visa.upload.quota');
Route::get('/visa/{slug}', [VisaController::class, 'show'])->name('visa.show');

// Air Ticketing
Route::get('/air-ticketing', [TicketingController::class, 'index'])->name('ticketing.index');
Route::get('/air-ticketing/request', [TicketingController::class, 'index'])->name('ticketing');
Route::post('/air-ticketing', [TicketingController::class, 'store'])->middleware('throttle:15,1')->name('ticketing.store');

// Content & Auxiliaries
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/photos', [GalleryController::class, 'index'])->name('gallery');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/faqs', [FaqController::class, 'index'])->name('faq');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:15,1')->name('contact.store');

// CMS Pages (Privacy, Terms, Refund, Disclaimer)
Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');
Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');

// Admin Controller Imports
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\VisaApplicationController as AdminVisaAppController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\TicketRequestController as AdminTicketController;
use App\Http\Controllers\Admin\ContactMessageController as AdminMessageController;
use App\Http\Controllers\Admin\TourAdminController;
use App\Http\Controllers\Admin\DestinationAdminController;
use App\Http\Controllers\Admin\VisaCountryAdminController;
use App\Http\Controllers\Admin\BlogAdminController;
use App\Http\Controllers\Admin\GalleryAdminController;
use App\Http\Controllers\Admin\SettingAdminController;

/*
|--------------------------------------------------------------------------
| Admin Auth & Operations Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    // Guest Admin Auth Routes
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::match(['get', 'post'], '/logout-fallback', [AdminAuthController::class, 'logout'])->name('logout');

    // Protected Admin Operations
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // Visa Applications Management
        Route::get('/visa-applications', [AdminVisaAppController::class, 'index'])->name('admin.visa.applications');
        Route::get('/visa-applications/{id}', [AdminVisaAppController::class, 'show'])->name('admin.visa.applications.show');
        Route::patch('/visa-applications/{id}/status', [AdminVisaAppController::class, 'updateStatus'])->name('admin.visa.applications.status');
        Route::patch('/visa-applications/{id}/document/{docId}/status', [AdminVisaAppController::class, 'updateDocumentStatus'])->name('admin.visa.applications.document.status');
        Route::get('/visa-applications/{id}/document/{docId}/download', [AdminVisaAppController::class, 'downloadDocument'])->name('admin.visa.applications.download');

        // Tour Inquiries Management
        Route::get('/inquiries', [AdminInquiryController::class, 'index'])->name('admin.inquiries');
        Route::patch('/inquiries/{id}/status', [AdminInquiryController::class, 'updateStatus'])->name('admin.inquiries.status');

        // Air Ticket Requests Management
        Route::get('/ticket-requests', [AdminTicketController::class, 'index'])->name('admin.ticket-requests');
        Route::patch('/ticket-requests/{id}/status', [AdminTicketController::class, 'updateStatus'])->name('admin.ticket-requests.status');

        // Contact Messages
        Route::get('/contact-messages', [AdminMessageController::class, 'index'])->name('admin.contact-messages');
        Route::patch('/contact-messages/{id}/read', [AdminMessageController::class, 'markRead'])->name('admin.contact-messages.read');
        Route::patch('/contact-messages/{id}/replied', [AdminMessageController::class, 'markReplied'])->name('admin.contact-messages.replied');
        Route::delete('/contact-messages/{id}', [AdminMessageController::class, 'destroy'])->name('admin.contact-messages.destroy');

        // Tours CMS
        Route::resource('/tours', TourAdminController::class)->names('admin.tours');
        Route::patch('/tours/{id}/toggle-featured', [TourAdminController::class, 'toggleFeatured'])->name('admin.tours.toggle-featured');

        // Destinations CMS
        Route::resource('/destinations', DestinationAdminController::class)->names('admin.destinations');

        // Visa Countries & Rules CMS
        Route::resource('/visa-countries', VisaCountryAdminController::class)->names('admin.visa.countries');

        // Blog CMS
        Route::resource('/blog', BlogAdminController::class)->names('admin.blog');

        // Gallery CMS
        Route::get('/gallery', [GalleryAdminController::class, 'index'])->name('admin.gallery.index');
        Route::post('/gallery', [GalleryAdminController::class, 'store'])->name('admin.gallery.store');
        Route::delete('/gallery/{id}', [GalleryAdminController::class, 'destroy'])->name('admin.gallery.destroy');

        // Settings
        Route::get('/settings', [SettingAdminController::class, 'index'])->name('admin.settings');
        Route::post('/settings', [SettingAdminController::class, 'update'])->name('admin.settings.update');
    });
});
