# Master API Integration Issue Register

**Project**: Emisha Tours & Travels — Full-Stack Platform **System
Architecture**: Laravel 12.x Backend ↔ REST / JSON / Multipart Endpoints ↔ Vue 3
Reactive Islands & Alpine.js ↔ MySQL Database **Audit Date**: September 19, 2026
**Status**: All Audited Workflows Active & Verified (100% Pass)

---

## 1. Integration Layers Key

- **DB**: MySQL Database / Migrations / Seeders / Schema Constraints
- **ROUTE**: Laravel Routing (`routes/web.php`)
- **MID**: Middleware (`auth`, `throttle`, CSRF)
- **CTRL**: Controllers (`app/Http/Controllers/`)
- **VAL**: Form Requests & Validation Rules (`app/Http/Requests/`)
- **SRV**: Core Business Services (`app/Services/`)
- **MDL**: Eloquent Models & Relationships (`app/Models/`)
- **RESP**: JSON & HTTP Responses
- **FE-CLIENT**: Vue 3 API Client / Axios / Fetch / FormData Handler
- **FE-STORE**: Pinia Store & Reactive State
- **FE-UI**: Vue 3 Components & Blade UI Views

---

## 2. Master Issue & Audit Register

| Issue ID      | Module           | Workflow                                        | Layer                              | Severity     | Problem Description                                                                                               | Root Cause                                                                           | Fix Applied                                                                                                                                                                                      | Integration Status  |
| ------------- | ---------------- | ----------------------------------------------- | ---------------------------------- | ------------ | ----------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------- |
| **AUDIT-001** | Visa Module      | Onboarding Multi-Step Application Submission    | `FE-CLIENT` ↔ `VAL` ↔ `SRV` ↔ `DB` | **HIGH**     | Potential validation mismatch if user submits `destination_slug` without legacy numeric `visa_country_id`.        | Wizard forms can submit string slugs (`thailand`, `maldives`) or direct country IDs. | Added `prepareForValidation()` in `StoreVisaApplicationRequest` to dynamically map `destination_slug` to `VisaCountry` and auto-bind default `visa_type_id`.                                     | **VERIFIED (PASS)** |
| **AUDIT-002** | Visa Security    | Custom Document Upload Junk Flooding Protection | `VAL` ↔ `SRV` ↔ `RESP`             | **HIGH**     | Risk of storage exhaustion from repeated automated file submissions.                                              | Unrestricted file uploads without submission quotas.                                 | Implemented client IP/email rate-limiting with 3-attempt quota and progressive cooldown (5m / 1h) in `VisaOnboardingService` + `/visa/onboarding/upload-quota` endpoint.                         | **VERIFIED (PASS)** |
| **AUDIT-003** | Visa Tracking    | Live Flight Radar Status & Dossier Lookup       | `CTRL` ↔ `MDL` ↔ `FE-UI`           | **MEDIUM**   | Missing relations during tracking query causing N+1 or broken document list.                                      | `VisaApplication::where(...)` without eager-loaded relations.                        | Query updated to `with(['country', 'visaType', 'documents'])` in `VisaController@track` and formatted response with radar indicators.                                                            | **VERIFIED (PASS)** |
| **AUDIT-004** | Tour Catalog     | Reactive Tour Filter & Budget Range Query       | `FE-CLIENT` ↔ `CTRL` ↔ `SRV`       | **MEDIUM**   | Filter query parameters out-of-sync with backend pagination links.                                                | Parameter keys mismatching (`maxPrice` vs `max_price`).                              | Aligned parameter names in `TourFilterWidget.vue` to `max_price`, `duration`, `search`, `sort` and configured `withQueryString()` in Laravel paginator.                                          | **VERIFIED (PASS)** |
| **AUDIT-005** | Air Ticketing    | Fast Quote Request & Hotline Routing            | `VAL` ↔ `CTRL` ↔ `SRV` ↔ `DB`      | **MEDIUM**   | Air ticket requests require standard booking reference numbers and sanitized phone routing.                       | Missing reference number generation on submission.                                   | Integrated `TicketRequestService` to generate unique `TK-` reference IDs and flash feedback modal.                                                                                               | **VERIFIED (PASS)** |
| **AUDIT-006** | Admin Operations | Secure Visa Document Streaming                  | `MID` ↔ `CTRL` ↔ `SRV`             | **CRITICAL** | Private applicant documents (passports, bank statements) must never be publicly accessible via web URL.           | Direct public storage symlink risk.                                                  | Configured `visa_private` disk outside web root (`storage/app/private/visa_documents/`) and streamed exclusively via authorized route `/admin/visa-applications/{id}/document/{docId}/download`. | **VERIFIED (PASS)** |
| **AUDIT-007** | Admin UI         | Operations User Profile & Branding              | `FE-UI` ↔ `DB`                     | **LOW**      | User requested admin account name to be 'Naznin Alam' and blog author to always display 'Emisha Tours & Travels'. | Legacy placeholder in seeders and templates.                                         | Updated `DatabaseSeeder`, live database record, and blog views (`blog/index.blade.php`, `blog/show.blade.php`, `SeoService.php`).                                                                | **VERIFIED (PASS)** |

---

## 3. Layer-by-Layer Verification Summary

```text
[CLIENT ACTION] User submits Visa Onboarding Form
      ↓
[VUE / BLADE] Alpine.js / Vue collects FormData & Validates files
      ↓
[HTTP POST] /visa/apply (Multipart Payload + CSRF Header)
      ↓
[LARAVEL ROUTE] routes/web.php (Rate limit: 20 req/min)
      ↓
[FORM REQUEST] StoreVisaApplicationRequest (prepareForValidation resolves destination slug & types)
      ↓
[CONTROLLER] VisaController@storeApplication
      ↓
[SERVICE LAYER] VisaOnboardingService (Calculates fees, validates upload quota, writes private files)
      ↓
[DATABASE] MySQL Inserts into `visa_applications` and `visa_documents` tables
      ↓
[RESPONSE] JSON payload (AJAX) or 302 Redirect with tracking Reference ID
      ↓
[UI STATE] Instant Flight Radar Tracking & Confirmation Modal active
```
