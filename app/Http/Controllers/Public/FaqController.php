<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Services\SeoService;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function __construct(
        protected SeoService $seoService
    ) {}

    public function index(): View
    {
        $faqs = Faq::active()->orderBy('sort_order', 'asc')->get();
        $breadcrumbs = [
            'Home' => route('home'),
            'Frequently Asked Questions' => route('faq.index'),
        ];
        $breadcrumbSchema = $this->seoService->generateBreadcrumbSchema($breadcrumbs);
        $faqSchema = $this->seoService->generateFaqSchema($faqs);
        $schema = $faqSchema . "\n" . $breadcrumbSchema;

        return view('public.faq.index', compact('faqs', 'schema'));
    }
}
