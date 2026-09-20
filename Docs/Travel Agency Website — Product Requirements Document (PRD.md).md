# Travel Agency Website — Product Requirements Document

**Document Version:** 1.0  
**Status:** Product Definition / Development Ready  
**Primary Stack:** PHP, Laravel, MySQL, Vue.js  
**Hosting:** Hostinger  
**Domain:** Name.com  
**Development / AI Workflow:** Google Antigravity  
**Primary UI/UX Reference:** Travel Tracker BD  
**Brand Theme:** Premium Travel / Corporate / Modern  
**Primary Brand Color:** Navy Blue  
**Brand Accent:** Golden  
**Secondary Color:** Dark Grey  
**Target Market:** Bangladesh + International Travelers  
**Primary Objective:** Lead Generation, Tour Package Discovery, Visa Assistance, Air Ticketing Inquiry & Brand Trust

---

# 1. Product Overview

The product is a modern, premium, SEO-first online travel agency website designed to provide users with a centralized platform for:

- Tour package discovery
- International and domestic travel planning
- Visa assistance
- Air ticketing inquiry
- Customized tour planning
- Travel information
- Customer inquiries
- Digital visa application submission
- Customer communication

The website should not behave like a simple corporate brochure website.

It should function as a:

> **Digital Travel Discovery + Travel Service + Lead Generation Platform**

The public website will be powered primarily by Laravel for performance and SEO, while Vue.js will be used selectively for interactive UI components and the administrative dashboard.

---

# 2. Product Vision

## Vision Statement

Build a fast, trustworthy and premium digital travel platform where customers can discover destinations, explore tour packages, understand visa requirements, request air tickets and contact travel experts from a single website.

## Core Experience

```text
DISCOVER
    ↓
EXPLORE
    ↓
UNDERSTAND
    ↓
INQUIRE
    ↓
CONSULT
    ↓
BOOK / PROCESS
```

---

# 3. Business Goals

## Primary Goals

1. Generate qualified travel leads.
2. Increase tour package inquiries.
3. Increase visa service inquiries.
4. Increase air ticketing inquiries.
5. Establish strong online brand credibility.
6. Rank for relevant travel and visa-related searches.
7. Provide useful travel information to organic visitors.
8. Reduce manual inquiry management through the admin dashboard.
9. Allow non-technical staff to manage website content.
10. Create an architecture that can scale into an advanced travel platform later.

---

# 4. Target Users

## 4.1 Leisure Travelers

People searching for:

- Tour packages
- Family vacations
- Honeymoon packages
- Group tours
- International travel
- Domestic tours

## 4.2 Visa Applicants

Users looking for:

- Tourist visa
- Business visa
- Student visa
- Medical visa
- Family visa
- E-visa
- Country-specific visa assistance

## 4.3 Air Ticket Customers

Users requiring:

- Domestic tickets
- International tickets
- One-way tickets
- Round-trip tickets
- Multi-city tickets
- Group booking
- Corporate booking
- Reissue / refund assistance where offered

## 4.4 Corporate / Group Travelers

Users requiring:

- Corporate travel
- Group tours
- Group ticketing
- Customized itineraries

## 4.5 Returning Customers

Users who already know the brand and want quick:

- WhatsApp contact
- Phone call
- Inquiry submission
- Repeat booking

---

# 5. Design References

The website should take conceptual inspiration from leading Bangladesh travel websites and particularly use Travel Tracker BD as the primary UX reference.

Reference categories:

- Destination discovery
- Tour package cards
- Visa country architecture
- Inquiry flows
- Travel guides
- FAQ
- Trust sections
- Testimonials
- Content-driven SEO

Important:

> Do not copy the visual design, exact layouts, copywriting, images, branding or proprietary assets of any reference website.

The product must have its own visual identity.

---

# 6. Brand Identity

## 6.1 Primary Color

### Navy Blue

Recommended direction:

```text
#071A35
```

Usage:

- Header
- Hero overlay
- Major sections
- Footer
- Primary text surfaces
- Buttons where appropriate

---

## 6.2 Brand Accent

### Golden

Recommended direction:

```text
#D4AF37
```

Usage:

- CTA highlights
- Icons
- Borders
- Small labels
- Premium visual accents
- Active states
- Decorative elements

Golden should be used as an accent, not as the dominant background.

---

## 6.3 Secondary

### Dark Grey

Recommended direction:

```text
#252A31
```

Usage:

- Secondary text
- Dark cards
- Supporting UI
- Footer elements

---

## 6.4 Light Background

Recommended:

```text
#F8F9FB
```

---

# 7. Visual Design Direction

The visual identity should communicate:

- Premium
- Trustworthy
- Professional
- International
- Modern
- Travel-focused
- Corporate

Avoid:

- Excessive gradients
- Excessive glassmorphism
- Overly rounded UI
- Too many animations
- Cheap-looking stock visuals
- Excessive shadows
- Cluttered layouts
- Giant carousel-heavy homepage

Preferred visual language:

```text
Deep Navy
+
Elegant Gold
+
Clean White
+
Large Destination Photography
+
Generous Whitespace
+
Modern Typography
+
Subtle Motion
```

---

# 8. Typography

## English

Preferred:

```text
Poppins
```

Alternative:

```text
Inter
```

## Bengali

Preferred:

```text
Hind Siliguri
```

Typography must support:

- Bangla
- English
- Mixed-language content

---

# 9. Website Sitemap

```text
HOME
│
├── ABOUT US
│
├── TOUR PACKAGES
│   ├── All Tours
│   ├── Domestic Tours
│   ├── International Tours
│   ├── Family Tours
│   ├── Honeymoon Tours
│   ├── Group Tours
│   ├── Customized Tours
│   └── Tour Details
│
├── VISA SERVICES
│   ├── All Visa Services
│   ├── Tourist Visa
│   ├── Business Visa
│   ├── Student Visa
│   ├── Medical Visa
│   ├── Family Visa
│   ├── E-Visa
│   └── Country-wise Visa
│
├── AIR TICKETING
│
├── DESTINATIONS
│
├── GALLERY
│
├── BLOG / TRAVEL GUIDE
│
├── FAQ
│
├── CONTACT US
│
├── PRIVACY POLICY
├── TERMS & CONDITIONS
├── REFUND & CANCELLATION POLICY
└── VISA DISCLAIMER
```

---

# 10. Homepage Requirements

The homepage is the primary conversion page.

Recommended order:

```text
01. Top Bar
02. Navigation
03. Hero
04. Quick Services
05. Featured Tour Packages
06. Popular Destinations
07. Visa Services
08. Exclusive Offers
09. Why Choose Us
10. How It Works
11. Customized Trip CTA
12. Testimonials
13. Travel Guide / Blog
14. FAQ
15. Final CTA
16. Footer
```

---

# 11. Header

## Desktop

Top utility bar:

```text
Phone
WhatsApp
Email
```

Main navigation:

```text
LOGO

Home
About
Tours
Visa
Air Ticketing
Gallery
Contact

[ Get Started ]
```

## Mobile

```text
LOGO
        ☰
```

Navigation must be mobile-friendly.

---

# 12. Hero Section

## Objective

Immediately communicate:

- What the company does
- Where users can go
- How the company can help

Suggested copy:

### Heading

> Your Journey. Our Expertise.

### Supporting Copy

> Explore the world with trusted tour planning, visa assistance and air ticketing services.

Primary CTA:

```text
Explore Tours
```

Secondary CTA:

```text
Visa Assistance
```

---

# 13. Destination Search

Hero should contain a destination discovery component.

Example:

```text
Where do you want to go?

[ Search destination... ]

Popular:
Thailand | Maldives | Dubai | Singapore | Malaysia
```

Search should support:

- Destination name
- Country
- Tour package
- Visa destination

---

# 14. Quick Services

Three major service cards:

## Tour Packages

```text
Explore curated travel packages.
```

CTA:

```text
Explore Tours
```

## Visa Services

```text
Get professional visa assistance.
```

CTA:

```text
Explore Visa
```

## Air Ticketing

```text
Request domestic and international airfare.
```

CTA:

```text
Request Fare
```

---

# 15. Featured Tour Packages

Section heading:

> Featured Tour Packages

Each card should include:

- Destination
- Package name
- Cover image
- Duration
- Starting price
- Short highlights
- Featured/Popular badge
- CTA

Example:

```text
Thailand Escape

Bangkok • Pattaya

5 Days / 4 Nights

From ৳XX,XXX

[ View Package ]
```

Admin must be able to mark packages as:

- Featured
- Popular
- Offer
- Active
- Inactive

---

# 16. Popular Destinations

Destination cards:

```text
Thailand
Maldives
Dubai
Singapore
Malaysia
Indonesia
Nepal
Sri Lanka
Turkey
Europe
USA
Canada
```

Each destination should have:

- Image
- Destination name
- Package count
- CTA

Example:

```text
Thailand

12 Tour Packages

[ Explore ]
```

---

# 17. Destination System

Dynamic route:

```text
/destinations
```

Country route:

```text
/destinations/thailand
/destinations/maldives
/destinations/dubai
```

Destination page should contain:

```text
Hero
About Destination
Popular Places
Best Time to Visit
Tour Packages
Visa Information
Travel Tips
FAQ
CTA
```

---

# 18. Visa Services

Homepage visa section:

```text
Visa Assistance

USA
Canada
UK
Australia
Schengen
Japan
South Korea
Thailand
Malaysia
Singapore
UAE
Turkey
```

Each card:

```text
Country
Visa type
Processing information
View Details
```

---

# 19. Visa Landing Page

Route:

```text
/visa
```

Features:

- Country search
- Visa type filter
- Popular destinations
- Visa categories
- Visa process
- Required documents
- CTA

---

# 20. Visa Country Page

Example:

```text
/visa/thailand
```

Content:

```text
Thailand Tourist Visa

Processing Time*
Visa Type
Starting Fee*
Service Fee*
Required Documents
Application Process
Profession-based Requirements
Important Notes
FAQs
Application CTA
```

Any time-sensitive information must display:

> Information is subject to change. Please confirm current requirements before application.

---

# 21. Profession-Based Visa Checklist

Optional advanced feature.

User selects:

```text
Salaried
Business Owner
Student
Freelancer
Retired
Housewife
Other
```

System displays relevant recommended documents.

Example:

```text
Salaried Applicant

✓ Passport
✓ Photograph
✓ Bank Statement
✓ Salary Certificate
✓ Employment Certificate
✓ NOC
```

This checklist must be configurable from the admin panel.

---

# 22. Visa Application

Route:

```text
/visa/apply
```

Multi-step application:

```text
STEP 01
Applicant Information

STEP 02
Travel Information

STEP 03
Document Upload

STEP 04
Review

STEP 05
Submit
```

---

# 23. Applicant Information

Fields:

```text
Full Name
Phone
Email
Date of Birth
Nationality
Passport Number
```

---

# 24. Travel Information

Fields:

```text
Destination
Visa Type
Purpose
Expected Travel Date
Expected Stay Duration
Number of Travelers
```

---

# 25. Document Upload

Potential documents:

```text
Passport
Photograph
NID
Bank Statement
Bank Solvency
Employment Certificate
Salary Certificate
NOC
Trade License
Previous Visa
Invitation Letter
Other Documents
```

Requirements must be configurable by visa country/type.

---

# 26. Application Reference Number

After submission:

```text
Application Submitted Successfully

Reference:
VISA-2026-001245
```

Admin should be able to track:

```text
Received
Under Review
Documents Required
Processing
Submitted
Decision Received
Completed
Rejected
Cancelled
```

---

# 27. Visa Disclaimer

Display on relevant visa pages:

> Visa approval is solely determined by the relevant embassy, consulate or immigration authority. The agency provides application and documentation assistance and cannot guarantee visa approval.

---

# 28. Air Ticketing Page

Route:

```text
/air-ticketing
```

Primary tabs:

```text
Round Trip
One Way
Multi City
```

Fields:

```text
From
To
Departure Date
Return Date
Adults
Children
Infants
Cabin Class
Preferred Airline
Additional Requirements
```

CTA:

```text
Request Fare
```

---

# 29. Air Ticketing Services

Display:

```text
Domestic Tickets
International Tickets
Group Booking
Corporate Booking
Date Change
Reissue
Refund Assistance
```

Only show services actually offered by the company.

---

# 30. Tour Packages Page

Route:

```text
/tours
```

Filters:

```text
Destination
Country
Tour Type
Duration
Budget
Travel Month
```

Tour categories:

```text
Family
Honeymoon
Couple
Group
Adventure
Luxury
Budget
Corporate
Customized
```

---

# 31. Tour Details

Route:

```text
/tours/{slug}
```

Required sections:

```text
Hero
Package Overview
Highlights
Itinerary
Accommodation
Transportation
Package Includes
Package Excludes
Important Information
Cancellation Policy
FAQs
Inquiry CTA
```

---

# 32. Tour Itinerary

Day-by-day accordion:

```text
Day 01
Arrival & Hotel Check-in

Day 02
City Tour

Day 03
Destination Transfer

Day 04
Sightseeing

Day 05
Departure
```

Admin must be able to add unlimited itinerary days.

---

# 33. Customized Tour

CTA:

> Your Trip. Your Way.

Form:

```text
Destination
Travel Date
Duration
Number of Travelers
Budget
Tour Type
Accommodation Preference
Special Requirements
Phone
Email
```

Admin receives inquiry notification.

---

# 34. Offers

Admin-managed promotional content.

Fields:

```text
Offer Title
Description
Destination
Discount
Start Date
End Date
Image
CTA
Status
```

Expired offers should automatically become inactive.

---

# 35. Why Choose Us

Suggested benefits:

```text
Transparent Pricing
Professional Assistance
Secure Documentation
Personalized Travel Planning
Experienced Consultants
Dedicated Customer Support
```

Each benefit should have:

- Icon
- Title
- Short description

---

# 36. How It Works

Four-step process:

```text
01
Consultation

02
Planning

03
Booking / Application

04
Travel
```

This section should adapt depending on service where necessary.

---

# 37. Testimonials

Admin-managed testimonials.

Fields:

```text
Customer Name
Photo
Destination
Service
Review
Rating
Source
Featured
Status
```

Never create fake testimonials.

---

# 38. Gallery

Route:

```text
/gallery
```

Categories:

```text
All
Tour Moments
Client Moments
Destinations
Group Tours
Office
Events
```

Features:

- Lazy loading
- Lightbox
- Responsive masonry/grid
- Optimized images

---

# 39. Blog / Travel Guide

Route:

```text
/blog
```

Purpose:

- Organic SEO
- Travel education
- Destination discovery
- Visa education
- Lead generation

Example articles:

```text
Thailand Tour Cost from Bangladesh
Thailand Visa Requirements
Dubai Tourist Visa Guide
Maldives Tour Package Guide
Schengen Visa Guide
Best Time to Visit Thailand
```

---

# 40. Blog Detail

Required:

```text
Title
Featured Image
Author
Published Date
Updated Date
Content
Table of Contents
FAQ
Related Tours
Related Visa Services
CTA
Related Articles
```

SEO metadata must be editable.

---

# 41. FAQ

Route:

```text
/faq
```

Categories:

```text
Tour Booking
Visa
Air Ticket
Payment
Refund
Cancellation
Travel
Documents
```

Admin can create/update/delete FAQs.

---

# 42. Contact Page

Route:

```text
/contact
```

Information:

```text
Phone
WhatsApp
Email
Office Address
Business Hours
```

Features:

- Contact form
- Google Maps
- WhatsApp CTA
- Call CTA
- Email CTA

---

# 43. Contact Form

Fields:

```text
Name
Phone
Email
Service
Travel Date
Message
```

Admin receives submission.

---

# 44. Mobile Sticky CTA

On mobile:

```text
[ WhatsApp ] [ Call ] [ Inquiry ]
```

This should remain accessible without obstructing content.

---

# 45. Admin Dashboard

Route:

```text
/admin
```

Dashboard should provide:

```text
Total Tours
Active Tours
Visa Applications
Tour Inquiries
Ticket Requests
Contact Messages
Unread Messages
Blog Posts
```

---

# 46. Admin Modules

```text
Dashboard

Tours
├── All Tours
├── Add Tour
├── Categories
├── Destinations
└── Itineraries

Visa
├── Countries
├── Visa Types
├── Requirements
├── Applications
└── Documents

Air Ticket Requests

Tour Inquiries

Contact Messages

Offers

Gallery

Testimonials

Blog
├── Posts
├── Categories
└── Authors

Pages

FAQ

SEO Manager

Media Library

Users

Roles & Permissions

Settings

Activity Logs
```

---

# 47. Homepage Manager

Admin should control homepage sections.

Example:

```text
Homepage Manager

[✓] Hero
[✓] Quick Services
[✓] Featured Tours
[✓] Destinations
[✓] Visa Services
[✓] Offers
[✓] Why Choose Us
[✓] How It Works
[✓] Testimonials
[✓] Blog
[✓] FAQ
[✓] Final CTA
```

Each section should support:

```text
Enable / Disable
Sort Order
Title
Subtitle
Content
Image
CTA
```

---

# 48. SEO Manager

Every indexable page should support:

```text
SEO Title
Meta Description
Focus Keyword
Slug
Canonical URL
OG Title
OG Description
OG Image
Robots
Schema Type
```

---

# 49. SEO URL Strategy

Use clean URLs.

Examples:

```text
/tours
/tours/thailand-tour-package
/tours/maldives-family-tour

/visa
/visa/thailand-tourist-visa
/visa/canada-tourist-visa

/destinations
/destinations/thailand

/blog
/blog/thailand-tour-cost-from-bangladesh
```

Avoid:

```text
?id=123
?page=4
/product?id=99
```

for public SEO pages wherever possible.

---

# 50. Technical SEO

Required:

- Server-rendered public pages
- Semantic HTML
- Unique title tags
- Unique meta descriptions
- Canonical URLs
- XML sitemap
- Robots.txt
- Breadcrumbs
- Schema markup
- Open Graph
- Twitter/X cards
- Image alt text
- Clean URLs
- Internal linking
- Proper heading hierarchy
- 404 page
- 301 redirects
- Pagination SEO
- No duplicate content
- Structured data validation

---

# 51. Schema Strategy

Use applicable structured data:

```text
Organization
TravelAgency
LocalBusiness
WebSite
WebPage
BreadcrumbList
TouristTrip
Product
FAQPage
Article
ImageObject
```

Do not add schema that does not accurately represent the page.

---

# 52. Performance Requirements

The website must be designed for fast loading.

## Requirements

- Optimized images
- WebP/AVIF
- Responsive image sizes
- Lazy loading
- Critical CSS
- Minified CSS/JS
- Code splitting
- Browser caching
- Server caching
- Database indexing
- Query optimization
- Pagination
- CDN-ready architecture
- Gzip/Brotli where supported
- Avoid unnecessary third-party scripts

---

# 53. Laravel + Vue Architecture

Public website:

```text
Laravel
    ↓
Blade / Server-rendered HTML
    ↓
SEO-friendly pages
    ↓
Vue components where interaction is required
```

Vue should NOT be used to unnecessarily turn the entire public website into a heavy SPA.

Use Vue for:

```text
Search
Filters
Forms
Dynamic fields
Gallery
Interactive widgets
Admin dashboard
```

---

# 54. Backend Architecture

Recommended Laravel structure:

```text
app/
├── Models/
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   └── Middleware/
├── Services/
├── Repositories/
├── Policies/
├── Notifications/
├── Jobs/
└── Helpers/
```

Use service classes for complex business logic.

---

# 55. Core Database Tables

```text
users
roles
permissions

tours
tour_categories
destinations
tour_itineraries
tour_inclusions
tour_exclusions

visa_countries
visa_types
visa_requirements
visa_profession_requirements
visa_applications
visa_documents

ticket_requests

tour_inquiries
contact_messages

offers

gallery_categories
gallery_images

testimonials

blogs
blog_categories

faqs

pages
seo_metadata

media
settings

activity_logs
```

---

# 56. User Roles

Minimum:

```text
Super Admin
Admin
Content Manager
Visa Manager
Tour Manager
Support Agent
```

Permissions must be role-based.

Example:

```text
tour.view
tour.create
tour.edit
tour.delete

visa.view
visa.create
visa.edit
visa.delete
visa.application.manage

inquiry.view
inquiry.update

blog.create
blog.edit
blog.publish
```

---

# 57. Security

Required:

- CSRF protection
- XSS protection
- SQL injection protection
- Authentication
- Authorization
- Rate limiting
- Secure password hashing
- File upload validation
- MIME validation
- File size restrictions
- Private document storage
- Signed/private document URLs
- Audit logs
- Secure session handling
- Admin activity tracking

Sensitive visa documents must never be publicly accessible through predictable URLs.

---

# 58. Document Security

Uploaded documents such as:

```text
Passport
NID
Bank Statement
Bank Solvency
Employment Documents
```

must be stored in private storage.

Admin access must be permission-controlled.

Direct public filesystem access must be disabled.

---

# 59. Notifications

When a new inquiry is submitted:

```text
Admin Dashboard Notification
Email Notification
Optional WhatsApp Notification
```

When visa application status changes:

```text
Customer Notification
```

Notification channels should be configurable.

---

# 60. Inquiry Management

Each inquiry receives:

```text
Unique ID
Customer Name
Phone
Email
Service
Date
Status
Assigned Staff
Notes
Created At
Updated At
```

Status:

```text
New
Contacted
In Progress
Waiting for Customer
Converted
Closed
Cancelled
```

---

# 61. Search

Global website search should support:

```text
Tours
Destinations
Visa Countries
Blog Articles
```

Search results should be grouped by content type.

---

# 62. Filtering

Tour filtering:

```text
Destination
Country
Tour Type
Duration
Price
```

Visa filtering:

```text
Country
Visa Type
Processing Time
```

Filters should work without unnecessarily reloading large pages.

---

# 63. Responsive Requirements

The website must be designed for:

```text
Mobile
Tablet
Laptop
Desktop
Large Desktop
```

Minimum target widths:

```text
320px
375px
390px
768px
1024px
1280px
1440px
1920px
```

Do not simply scale desktop UI down to mobile.

Each breakpoint should have intentional layout behavior.

---

# 64. Accessibility

Target:

```text
WCAG 2.2 AA-oriented implementation
```

Requirements:

- Proper color contrast
- Keyboard navigation
- Visible focus states
- Semantic HTML
- Alt text
- Form labels
- Error messages
- Accessible buttons
- Accessible modal
- Screen-reader-friendly structure

---

# 65. Analytics

Recommended:

```text
Google Analytics 4
Google Search Console
Meta Pixel
```

Track:

```text
Tour View
Tour Inquiry
Visa View
Visa Application Start
Visa Application Submit
Ticket Request
Contact Form Submit
WhatsApp Click
Phone Click
Email Click
Blog View
```

Analytics should be implemented without significantly harming performance.

---

# 66. Conversion Tracking

Important events:

```text
view_tour
submit_tour_inquiry
view_visa
start_visa_application
submit_visa_application
request_ticket
submit_contact
click_whatsapp
click_phone
```

---

# 67. Error Handling

User-facing errors must be friendly.

Examples:

```text
Something went wrong.
Please try again.

Your application could not be submitted.
Please check the highlighted fields.
```

Never expose:

- SQL errors
- Stack traces
- Internal paths
- API keys
- Server details

---

# 68. Form Validation

All forms require:

- Client-side validation
- Server-side validation
- Required field validation
- Email validation
- Phone validation
- File type validation
- File size validation
- Anti-spam protection

Server-side validation is mandatory even when Vue validation exists.

---

# 69. Spam Protection

Inquiry/contact forms should support:

- Rate limiting
- Honeypot
- CAPTCHA when necessary
- IP throttling
- Duplicate submission protection

Avoid loading heavy CAPTCHA scripts unless required.

---

# 70. Media Management

Admin media library should support:

```text
Upload
Rename
Delete
Alt Text
Caption
Folder/Category
Image Optimization
```

Images should automatically generate optimized variants when practical.

---

# 71. Content Management

Admin users should be able to edit:

- Homepage
- About page
- Services
- Tour packages
- Visa information
- FAQs
- Blog
- Gallery
- Testimonials
- Contact information
- Footer
- SEO metadata

Developer intervention should not be required for routine content updates.

---

# 72. Environment Configuration

Sensitive configuration must use `.env`.

Never hardcode:

```text
Database credentials
Mail credentials
API keys
Payment credentials
Analytics secrets
Admin credentials
```

---

# 73. Deployment

Target environment:

```text
Hostinger
```

Deployment should support:

```text
Production
Staging
```

Recommended production flow:

```text
Git
↓
Build
↓
Migrate
↓
Cache Config
↓
Cache Routes
↓
Cache Views
↓
Optimize Assets
↓
Health Check
```

---

# 74. Database Performance

Use indexes for:

```text
slug
status
published_at
destination_id
tour_category_id
visa_country_id
visa_type_id
created_at
```

Avoid N+1 queries.

Use eager loading where appropriate.

Use pagination for:

- Tours
- Blogs
- Applications
- Inquiries
- Gallery
- Users

---

# 75. Caching

Recommended:

```text
Homepage cache
Destination cache
Visa information cache
Tour listing cache
Navigation cache
Settings cache
```

Invalidate relevant cache automatically after content updates.

---

# 76. Email System

Email templates should exist for:

```text
New Inquiry
New Visa Application
Ticket Request
Contact Form
Application Status Update
Admin Notification
```

Templates should be editable/configurable where practical.

---

# 77. Admin Dashboard UX

Admin UI should prioritize:

```text
Clarity
Speed
Data visibility
Low learning curve
```

Dashboard should not imitate the public site's premium marketing UI excessively.

Use a practical SaaS-style admin interface.

---

# 78. Dashboard Overview

Example:

```text
┌──────────────────────────────────────────────┐
│ Total Tours      Active Visa Apps           │
│ 48               17                          │
├──────────────────────────────────────────────┤
│ New Inquiries    Ticket Requests             │
│ 32               11                          │
└──────────────────────────────────────────────┘
```

Charts:

```text
Inquiry Trend
Popular Destinations
Visa Applications
Tour Views
```

---

# 79. SEO Content Strategy

Primary content clusters:

## Tours

```text
Thailand Tour
Maldives Tour
Dubai Tour
Malaysia Tour
Singapore Tour
Turkey Tour
```

## Visa

```text
Thailand Visa
Dubai Visa
Canada Visa
USA Visa
UK Visa
Schengen Visa
Australia Visa
```

## Travel Guides

```text
Travel Cost
Visa Requirements
Best Time to Visit
Things to Do
Travel Checklist
Airport Guide
Currency Guide
```

---

# 80. Internal Linking Strategy

Example:

Thailand article:

```text
Thailand Travel Guide
        ↓
Thailand Tour Packages
        ↓
Thailand Visa
        ↓
Thailand Destination
        ↓
Inquiry
```

Every important SEO page should have contextual internal links.

---

# 81. URL Canonicalization

One canonical URL per content entity.

Handle:

```text
Trailing slash
HTTP → HTTPS
WWW → non-WWW or chosen canonical
Duplicate query parameters
Pagination
```

with consistent rules.

---

# 82. Sitemap

Generate dynamic XML sitemap containing:

```text
Static Pages
Tours
Destinations
Visa Pages
Blog Posts
```

Exclude:

```text
Admin
Private Applications
User Pages
Internal Search
Duplicate Pages
```

---

# 83. Robots.txt

Allow public content.

Disallow:

```text
/admin
/account
/application
/private
/internal-search
```

Exact implementation must match the final routing architecture.

---

# 84. 404 Page

Custom branded 404:

> Looks like this journey took a wrong turn.

CTA:

```text
Back Home
Explore Tours
Contact Us
```

---

# 85. Loading States

Use lightweight skeletons for dynamic components.

Avoid full-page blocking loaders wherever possible.

---

# 86. Animation

Animation should be subtle.

Recommended:

- Fade-in
- Small slide
- Hover elevation
- Image zoom on card hover
- Smooth accordion
- Button interaction

Avoid:

- Heavy parallax
- Continuous animations
- Large JavaScript animation libraries without need

---

# 87. Performance Budget

Target:

```text
LCP < 2.5s
INP < 200ms
CLS < 0.1
```

Aim for strong Lighthouse scores, particularly:

```text
Performance
Accessibility
Best Practices
SEO
```

Actual performance will depend on hosting, content and third-party services.

---

# 88. Mobile-First Strategy

Design priority:

```text
Mobile
↓
Tablet
↓
Laptop
↓
Desktop
```

Important mobile elements:

- Sticky inquiry CTA
- Easy WhatsApp access
- Large touch targets
- Short forms
- Accordion content
- Optimized images
- Simplified navigation

---

# 89. Admin Content Status

Content entities should support:

```text
Draft
Published
Scheduled
Archived
```

For applicable content.

---

# 90. Audit Logs

Admin activity should record:

```text
User
Action
Entity
Entity ID
Timestamp
IP
```

Example:

```text
Admin changed Thailand visa processing time.
```

---

# 91. Future-Ready Architecture

The system should be designed so future features can be added without major rewrites.

Potential future features:

```text
Online Payment
Real-time Flight API
Hotel API
Travel Insurance
Customer Accounts
Booking Engine
Coupon System
CRM
WhatsApp API
SMS
Multi-language
Currency Conversion
Agent Portal
Corporate Portal
Mobile App API
```

These are NOT mandatory for MVP.

---

# 92. MVP Scope

## Must Have

```text
Homepage
About
Tour Packages
Tour Details
Visa Services
Visa Country Pages
Visa Application
Air Ticket Inquiry
Gallery
Contact
FAQ
Blog
SEO
Admin Dashboard
CMS
Inquiry Management
Media Management
User Roles
```

---

# 93. Phase 2

```text
Online Payment
Customer Account
Application Tracking
WhatsApp API
SMS
Advanced CRM
Flight API
Hotel API
Coupon
Booking Management
```

---

# 94. Phase 3

```text
Agent Portal
Corporate Travel Portal
Mobile App
Multi-language
Multi-currency
Advanced Analytics
AI Travel Assistant
AI Visa Document Assistant
```

---

# 95. Non-Functional Requirements

The system must be:

```text
Fast
Secure
Responsive
SEO-friendly
Maintainable
Scalable
Accessible
Mobile-first
CMS-driven
Production-ready
```

---

# 96. Development Principles

1. Do not over-engineer MVP.
2. Keep public pages SEO-first.
3. Keep Vue usage selective.
4. Keep Laravel architecture modular.
5. Never hardcode dynamic business content.
6. Never expose sensitive documents.
7. Never use fake testimonials or statistics.
8. Never promise visa approval.
9. Optimize images before production.
10. Keep third-party scripts minimal.
11. Build reusable components.
12. Use consistent naming conventions.
13. Validate everything server-side.
14. Keep database queries optimized.
15. Keep admin workflows simple.

---

# 97. Component System

Reusable public components:

```text
Navbar
TopBar
Hero
SearchBox
ServiceCard
TourCard
DestinationCard
VisaCard
OfferCard
TestimonialCard
BlogCard
FAQAccordion
CTASection
Footer
InquiryForm
VisaApplicationForm
GalleryGrid
Breadcrumb
Pagination
```

Admin components:

```text
Sidebar
TopNavigation
StatCard
DataTable
FilterBar
Modal
FormBuilder
MediaPicker
RichTextEditor
StatusBadge
ConfirmDialog
```

---

# 98. Recommended Frontend Folder Structure

```text
resources/
├── js/
│   ├── components/
│   │   ├── public/
│   │   └── admin/
│   ├── pages/
│   ├── composables/
│   ├── stores/
│   └── utils/
│
├── css/
│   ├── app.css
│   ├── components.css
│   └── utilities.css
│
└── views/
    ├── layouts/
    ├── components/
    ├── pages/
    └── admin/
```

---

# 99. Recommended API Strategy

Laravel APIs should be versioned:

```text
/api/v1/
```

Potential endpoints:

```text
GET /api/v1/tours
GET /api/v1/tours/{slug}

GET /api/v1/destinations
GET /api/v1/visa/countries

POST /api/v1/inquiries
POST /api/v1/visa-applications
POST /api/v1/ticket-requests
```

Public API access must be rate-limited.

---

# 100. Acceptance Criteria

The MVP will be considered complete when:

### Public Website

- [ ] All primary pages are implemented.
- [ ] Navigation works across desktop/mobile.
- [ ] Tour listings work.
- [ ] Tour detail pages work.
- [ ] Visa country pages work.
- [ ] Visa application form works.
- [ ] Air ticket inquiry works.
- [ ] Contact form works.
- [ ] Gallery works.
- [ ] Blog works.
- [ ] FAQ works.
- [ ] WhatsApp/Call CTAs work.

### Admin

- [ ] Admin login works.
- [ ] Role-based permissions work.
- [ ] Tours can be created/edited/deleted.
- [ ] Destinations can be managed.
- [ ] Visa content can be managed.
- [ ] Visa applications can be tracked.
- [ ] Ticket inquiries can be managed.
- [ ] Tour inquiries can be managed.
- [ ] Gallery can be managed.
- [ ] Blog can be managed.
- [ ] Testimonials can be managed.
- [ ] SEO metadata can be managed.
- [ ] Homepage sections can be managed.

### SEO

- [ ] XML sitemap exists.
- [ ] Robots.txt exists.
- [ ] Canonicals exist.
- [ ] Metadata exists.
- [ ] Structured data exists where applicable.
- [ ] URLs are SEO-friendly.
- [ ] Images have alt text.
- [ ] Heading hierarchy is correct.

### Performance

- [ ] Images optimized.
- [ ] Lazy loading implemented.
- [ ] JS minimized/bundled.
- [ ] CSS optimized.
- [ ] Database indexed.
- [ ] N+1 queries eliminated.
- [ ] Caching configured.
- [ ] Third-party scripts minimized.

### Security

- [ ] Authentication secured.
- [ ] Authorization implemented.
- [ ] Upload validation implemented.
- [ ] Private visa documents protected.
- [ ] Rate limiting enabled.
- [ ] CSRF enabled.
- [ ] Sensitive credentials stored in environment variables.
- [ ] Production debug disabled.

---

# 101. Final Product Definition

The final product should feel like:

> **A premium digital travel agency rather than a conventional travel-agency brochure website.**

The user should be able to move naturally from:

```text
Destination Discovery
        ↓
Tour / Visa Information
        ↓
Package Evaluation
        ↓
Inquiry
        ↓
Consultation
        ↓
Booking / Application
```

The system should simultaneously serve three purposes:

```text
BRAND WEBSITE
        +
LEAD GENERATION PLATFORM
        +
CONTENT / SEO PLATFORM
```

The architecture should remain flexible enough to evolve into:

```text
Travel Agency Website
        ↓
Travel Booking Platform
        ↓
Travel CRM
        ↓
Full Digital Travel Ecosystem
```

---

# 102. Product Success Metrics

Track:

```text
Organic Traffic
Tour Package Views
Tour Inquiry Rate
Visa Page Views
Visa Application Rate
Air Ticket Inquiry Rate
WhatsApp Clicks
Phone Clicks
Contact Form Submissions
Lead Conversion
Top Destinations
Top Visa Countries
Blog Organic Traffic
Returning Visitors
```

The ultimate goal is not simply website traffic.

The key business outcome is:

> **Qualified travel inquiries and converted customers generated through the website.**

---

# 103. Final Technology Stack

## Backend

```text
PHP
Laravel
MySQL
```

## Frontend

```text
Blade
Vue.js
JavaScript
HTML5
CSS3
```

## Hosting

```text
Hostinger
```

## Domain

```text
Name.com
```

## Development

```text
Google Antigravity
Git / GitHub
```

## Analytics

```text
Google Analytics 4
Google Search Console
Meta Pixel
```

---

# 104. Development Priority

```text
PHASE 01
Foundation
↓
Brand System
↓
Database
↓
Authentication
↓
Admin Core

PHASE 02
Public Website
↓
Homepage
↓
Tours
↓
Visa
↓
Ticketing
↓
Contact

PHASE 03
Content
↓
Blog
↓
FAQ
↓
Gallery
↓
SEO

PHASE 04
Optimization
↓
Performance
↓
Security
↓
Accessibility
↓
Analytics

PHASE 05
Testing
↓
Mobile
↓
Tablet
↓
Desktop
↓
Cross-browser
↓
Production
```

---

# 105. Design Reference Principle

**Primary UX reference:** Travel Tracker BD

Reference elements may influence:

- Information architecture
- User journey
- Destination discovery
- Package presentation
- Visa information organization
- Inquiry flow
- Content structure

But the final website must have a distinct:

> **Navy + Golden premium travel identity**

with original layouts, components, copy, imagery and branding.

---

# END OF PRD