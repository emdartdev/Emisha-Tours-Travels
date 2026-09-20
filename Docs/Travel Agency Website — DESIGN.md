# Travel Agency Website — DESIGN.md

**Version:** 1.0  
**Design Status:** Production Design Specification  
**Primary Reference:** Travel Tracker BD  
**Brand Style:** Premium Travel / Modern Corporate / Elegant  
**Primary Color:** Navy Blue  
**Accent:** Golden  
**Secondary:** Dark Grey  
**Typography:** Poppins + Hind Siliguri  
**Design Approach:** Mobile-first, responsive, performance-first, SEO-first

---

# 1. Design Philosophy

The website should communicate three things within the first few seconds:

> **Trust + Travel + Professional Expertise**

The design should feel premium without becoming visually heavy.

The visual hierarchy should follow:

```text
BRAND
  ↓
DESTINATION
  ↓
SERVICE
  ↓
PACKAGE
  ↓
INFORMATION
  ↓
ACTION
```

The design must prioritize conversion over decoration.

---

# 2. Primary Visual Direction

## Design Keywords

```text
Premium
Elegant
Trustworthy
Modern
International
Clean
Travel-focused
Professional
Warm
Confident
```

## Avoid

```text
Cheap-looking travel templates
Overloaded sliders
Excessive glassmorphism
Excessive gradients
Too many colors
Huge decorative animations
Over-rounded cards
Cluttered layouts
Tiny text
Low-quality stock imagery
```

---

# 3. Brand Color System

## Primary — Navy Blue

```text
Primary Navy:
#071A35
```

Use for:

- Header
- Hero overlays
- Dark sections
- Footer
- Primary text
- Primary buttons
- Navigation

---

## Deep Navy

```text
#041226
```

Use for:

- Footer
- Dark CTA sections
- Strong contrast backgrounds

---

## Golden Accent

```text
#D4AF37
```

Use for:

- Primary accent
- Icons
- CTA highlights
- Active states
- Small borders
- Premium labels
- Decorative details

---

## Light Gold

```text
#E8D28A
```

Use sparingly for:

- Hover states
- Subtle backgrounds
- Decorative elements

---

## Dark Grey

```text
#252A31
```

Use for:

- Secondary text
- Dark cards
- Supporting UI

---

## Body Background

```text
#F8F9FB
```

---

## White

```text
#FFFFFF
```

Use for:

- Cards
- Navigation
- Content areas
- Forms

---

# 4. Color Usage Ratio

Recommended approximate visual balance:

```text
Navy        35%
White       40%
Light Gray  15%
Golden       8%
Dark Grey    2%
```

Golden must remain an accent.

Do not make the website predominantly gold.

---

# 5. Typography

## English

Primary:

```text
Poppins
```

Fallback:

```text
Inter, Arial, sans-serif
```

## Bengali

Primary:

```text
Hind Siliguri
```

---

# 6. Typography Scale

## Desktop

```text
Display:
64px / 1.05 / 700

H1:
52px / 1.1 / 700

H2:
40px / 1.15 / 700

H3:
28px / 1.2 / 600

H4:
22px / 1.3 / 600

Body Large:
18px / 1.6 / 400

Body:
16px / 1.6 / 400

Small:
14px / 1.5 / 400

Caption:
12px / 1.4 / 500
```

---

# 7. Mobile Typography

```text
Display:
38px

H1:
34px

H2:
28px

H3:
22px

H4:
18px

Body Large:
17px

Body:
15px

Small:
13px

Caption:
11px
```

Avoid extremely large typography on small screens.

---

# 8. Font Weight

```text
400 — Regular
500 — Medium
600 — Semi Bold
700 — Bold
```

Use 700 selectively.

---

# 9. Layout System

Use a consistent max-width container.

Desktop:

```text
max-width: 1280px
```

Large desktop:

```text
max-width: 1440px
```

Mobile:

```text
padding: 20px
```

Tablet:

```text
padding: 32px
```

Desktop:

```text
padding: 48px
```

---

# 10. Grid System

## Desktop

12-column grid.

```text
12 columns
24px gap
```

## Tablet

8-column grid.

## Mobile

4-column conceptual grid.

Most mobile sections should use a single-column layout.

---

# 11. Spacing System

Use a consistent 8px-based spacing system.

```text
4px
8px
12px
16px
24px
32px
40px
48px
64px
80px
96px
120px
```

Section spacing:

Desktop:

```text
80–120px
```

Tablet:

```text
64–80px
```

Mobile:

```text
48–64px
```

---

# 12. Border Radius

Use moderate rounding.

```text
Small:
8px

Medium:
12px

Large:
16px

Hero / Feature:
20px
```

Avoid excessive 32–50px rounded cards.

---

# 13. Shadows

Use subtle shadows only.

Example conceptual levels:

```text
Shadow Small:
0 4px 15px rgba(0,0,0,0.06)

Shadow Medium:
0 10px 30px rgba(0,0,0,0.08)
```

Do not make every element floating.

---

# 14. Borders

Default:

```text
1px solid #E5E7EB
```

Premium accent:

```text
1px solid Golden
```

Golden borders should be used sparingly.

---

# 15. Navigation Design

## Desktop

Top utility bar:

```text
----------------------------------------------------
Call | WhatsApp | Email                    Language
----------------------------------------------------
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
Blog
Contact

                  [ Get Started ]
```

---

# 16. Header Behavior

Desktop:

- Sticky header
- Slight shadow after scroll
- Navy or white surface depending on hero treatment

Hero-overlap version:

```text
Transparent Navbar
        ↓
Scroll
        ↓
Solid Navy Navbar
```

If implemented, transition must be lightweight.

---

# 17. Mobile Header

```text
┌──────────────────────────────┐
│ LOGO                    ☰    │
└──────────────────────────────┘
```

Menu opens as:

```text
Home
About Us
Tour Packages
Visa Services
Air Ticketing
Destinations
Gallery
Blog
FAQ
Contact
```

Primary CTA:

```text
[ Get Started ]
```

---

# 18. Hero Design

Hero is the visual signature of the website.

Use a large cinematic travel image.

Recommended:

```text
Full width
Minimum height: 650px desktop
Minimum height: 600px tablet
Minimum height: 620px mobile
```

Do not use a heavy image carousel.

Prefer one strong hero image or very limited rotation.

---

# 19. Hero Overlay

Use navy overlay:

```text
Image
+
Dark Navy Gradient
+
Content
```

Text should remain highly readable.

Golden accent can highlight one phrase.

Example:

> Explore the World.  
> **Travel With Confidence.**

---

# 20. Hero Content Alignment

Desktop:

```text
Left aligned
Maximum content width: 600px
```

Mobile:

```text
Left aligned
Full width
```

Avoid center alignment unless the selected reference composition strongly requires it.

---

# 21. Hero Search

Search component:

```text
┌─────────────────────────────────────────────┐
│ 🔍 Where do you want to go?                 │
│                                             │
│ Thailand     Maldives     Dubai     Bali    │
└─────────────────────────────────────────────┘
```

Desktop search may sit beneath the hero copy.

Mobile search becomes full width.

---

# 22. Primary Button

Default:

```text
Background: Navy
Text: White
Border: None
Radius: 10–12px
Height: 48–52px
Padding: 0 24px
```

Hover:

```text
Background → Darker Navy
```

---

# 23. Golden CTA Button

For high-priority conversion:

```text
Background: Golden
Text: Navy
```

Use for:

- Get Started
- Apply Now
- Request Fare
- Plan My Trip

Do not make every button gold.

---

# 24. Secondary Button

```text
Background: Transparent
Border: 1px solid Navy
Text: Navy
```

On dark backgrounds:

```text
Border: White
Text: White
```

---

# 25. Service Cards

Three primary cards:

```text
┌───────────────────────┐
│ ✈                     │
│ Air Ticketing         │
│                       │
│ Domestic & worldwide  │
│ airfare assistance    │
│                       │
│ Request Fare →        │
└───────────────────────┘
```

Cards should be clean and compact.

---

# 26. Service Card Hover

Desktop:

```text
Translate Y:
-4px

Shadow:
Increase slightly

Icon:
Golden highlight
```

Avoid exaggerated 3D animation.

---

# 27. Featured Tour Card

Structure:

```text
┌─────────────────────────────┐
│                             │
│       DESTINATION IMAGE     │
│                             │
│  [ Featured ]               │
├─────────────────────────────┤
│ Thailand Escape             │
│ Bangkok • Pattaya           │
│                             │
│ 5 Days / 4 Nights           │
│                             │
│ From                        │
│ ৳XX,XXX                     │
│                             │
│ [ View Package ]            │
└─────────────────────────────┘
```

---

# 28. Tour Image Ratio

Recommended:

```text
4:3
```

or:

```text
16:10
```

Avoid overly tall images that consume excessive vertical space.

---

# 29. Destination Card

Use image-first cards.

```text
┌─────────────────────┐
│                     │
│       IMAGE         │
│                     │
│                     │
│ Thailand            │
│ 12 Packages →      │
└─────────────────────┘
```

Text should sit over a subtle dark gradient or beneath the image.

---

# 30. Popular Destination Section

Desktop:

```text
Featured large destination
+
4–6 smaller destinations
```

Alternative:

```text
4-column grid
```

Mobile:

```text
Horizontal scroll
```

Do not create an enormous vertical list.

---

# 31. Visa Card

```text
┌─────────────────────────┐
│ 🇹🇭                     │
│ Thailand Visa           │
│                         │
│ Tourist / E-Visa        │
│                         │
│ View Requirements →     │
└─────────────────────────┘
```

Use small country flags carefully.

Do not rely on emoji flags as the only visual representation.

---

# 32. Visa Page Header

Hero:

```text
VISA SERVICES

Professional assistance for
your next international journey.

[ Search Visa Country ]
```

Use a dark navy section with subtle travel imagery.

---

# 33. Visa Country Page

Top:

```text
Thailand Tourist Visa

Processing Time*
Starting Fee*
Visa Type

[ Apply Now ]
```

Then:

```text
Overview
Required Documents
Eligibility
Profession-based Checklist
Application Process
Fees
Important Notes
FAQ
```

---

# 34. Visa Requirements UI

Use checklist cards:

```text
✓ Valid Passport
✓ Recent Photograph
✓ Bank Statement
✓ Employment Certificate
✓ Travel Itinerary
```

Avoid dense paragraphs.

---

# 35. Profession Selector

Interactive segmented cards:

```text
┌────────────┐ ┌────────────┐
│ Salaried   │ │ Business   │
└────────────┘ └────────────┘

┌────────────┐ ┌────────────┐
│ Student    │ │ Freelancer │
└────────────┘ └────────────┘
```

Selected state:

```text
Navy background
Golden border
White text
```

---

# 36. Visa Application Form

Use a multi-step UI.

```text
01 Applicant
───────●────────────
02 Travel
03 Documents
04 Review
05 Submit
```

On mobile, show:

```text
Step 1 of 5
```

instead of a wide horizontal timeline.

---

# 37. Document Upload UI

```text
┌─────────────────────────────────┐
│ Upload Passport                 │
│                                 │
│      ↑ Drag & Drop              │
│      or Browse Files            │
│                                 │
│ JPG / PNG / PDF                 │
└─────────────────────────────────┘
```

Show:

- filename
- file size
- upload status
- remove action

Never display sensitive documents publicly.

---

# 38. Tour Listing Page

Header:

```text
Explore Our Tour Packages

Find a journey that fits your plans.
```

Desktop:

```text
┌─────────────┬─────────────────────────────┐
│ FILTERS     │ TOUR GRID                   │
│             │                             │
│ Destination │ [Card] [Card] [Card]       │
│ Tour Type   │ [Card] [Card] [Card]       │
│ Duration    │                             │
│ Budget      │                             │
└─────────────┴─────────────────────────────┘
```

Mobile:

```text
[ Filters ] [ Sort ]

Cards
Cards
Cards
```

---

# 39. Tour Detail Layout

Desktop:

```text
┌───────────────────────────────────────────┐
│ HERO IMAGE                                │
│                                           │
│ Thailand Escape                           │
│ 5 Days / 4 Nights                         │
└───────────────────────────────────────────┘

┌──────────────────────┬────────────────────┐
│ Main Content         │ Booking Card       │
│                      │                    │
│ Overview             │ From ৳XX,XXX       │
│ Highlights           │                    │
│ Itinerary            │ [ Inquiry ]        │
│ Includes             │                    │
│ Excludes             │                    │
└──────────────────────┴────────────────────┘
```

The booking/inquiry card may become sticky on desktop.

---

# 40. Itinerary Design

Accordion:

```text
DAY 01
Arrival & Hotel Check-in              +

DAY 02
Bangkok City Tour                     +

DAY 03
Bangkok → Pattaya                     +

DAY 04
Pattaya Sightseeing                   +

DAY 05
Departure                             +
```

Expanded state reveals detailed information.

---

# 41. Package Includes / Excludes

Two visually distinct columns:

```text
INCLUDES
✓ Hotel
✓ Breakfast
✓ Transfer
✓ Sightseeing
```

```text
EXCLUDES
× Personal expenses
× Travel insurance
× Optional activities
```

Use iconography rather than heavy colors.

---

# 42. Customized Tour Section

Large dark section:

```text
YOUR TRIP.
YOUR WAY.

Can't find the perfect package?

Tell us what you need and we'll
help plan your trip.

[ Plan My Trip ]
```

Use destination image on one side.

---

# 43. How It Works

Four horizontal steps on desktop:

```text
01              02              03              04

Consult         Plan            Confirm         Travel
```

Mobile:

```text
01 Consultation
      ↓
02 Planning
      ↓
03 Confirmation
      ↓
04 Travel
```

---

# 44. Trust Section

Use clean icon cards:

```text
✓
Transparent Pricing

✓
Professional Assistance

✓
Secure Documentation

✓
Dedicated Support
```

No excessive decorative graphics.

---

# 45. Testimonials

Desktop:

```text
          ★★★★★

“Professional support throughout
our entire trip.”

Customer Name
Thailand Trip
Verified Client
```

Use 2–3 cards visible at once.

Mobile:

One card at a time.

---

# 46. Testimonial Source Badge

If verified:

```text
Google Review
Facebook Review
Website Review
```

Do not fabricate source labels.

---

# 47. Blog Card

```text
┌─────────────────────────┐
│      FEATURE IMAGE      │
├─────────────────────────┤
│ VISA GUIDE              │
│                         │
│ Thailand Visa Guide     │
│ for Bangladeshi         │
│ Travelers               │
│                         │
│ Read Article →          │
└─────────────────────────┘
```

Show:

- Category
- Title
- Date
- Read action

---

# 48. FAQ Design

Accordion:

```text
What documents do I need for a visa?       +

How long does visa processing take?        +

Can I customize a tour package?             +

How can I request an air ticket?            +
```

Only one or multiple items may be expanded depending on UX preference.

---

# 49. Final CTA

Dark Navy background.

```text
READY TO PLAN YOUR
NEXT JOURNEY?

Tell us where you want to go.

[ Explore Tours ]
[ Contact Us ]
```

Golden decorative line or icon.

---

# 50. Gallery Design

Desktop:

```text
┌────────────┬────────────┬────────────┐
│            │            │            │
│   Image    │   Image    │   Image    │
│            │            │            │
├────────────┼────────────┼────────────┤
│            │            │            │
│   Image    │   Image    │   Image    │
│            │            │            │
└────────────┴────────────┴────────────┘
```

Mobile:

```text
2-column grid
```

Use optimized images.

---

# 51. Contact Page

Desktop:

```text
┌──────────────────────┬──────────────────────┐
│ CONTACT INFORMATION  │ CONTACT FORM         │
│                      │                      │
│ Phone                │ Name                 │
│ WhatsApp             │ Phone                │
│ Email                │ Email                │
│ Address              │ Service              │
│                      │ Message              │
└──────────────────────┴──────────────────────┘

              GOOGLE MAP
```

Mobile becomes stacked.

---

# 52. Floating Contact Controls

Desktop:

Small floating:

```text
WhatsApp
```

Mobile:

Fixed bottom:

```text
┌──────────┬──────────┬──────────┐
│ WhatsApp │   Call   │ Inquiry  │
└──────────┴──────────┴──────────┘
```

Ensure it does not cover form controls.

---

# 53. Footer

Dark Navy footer.

Four columns:

```text
COMPANY
About
Why Us
Contact
Gallery

SERVICES
Tours
Visa
Air Ticketing
Customized Tours

DESTINATIONS
Thailand
Maldives
Dubai
Singapore
Malaysia

RESOURCES
Blog
Travel Guide
Visa Guide
FAQ
```

Bottom:

```text
Privacy
Terms
Refund Policy
Visa Disclaimer

© 2026 Brand Name
```

---

# 54. Mobile Footer

Accordion-style groups may be used:

```text
Company +
Services +
Destinations +
Resources +
```

Contact information remains visible.

---

# 55. Form Design

Inputs:

```text
Height: 48–52px
Radius: 10px
Border: #D9DEE7
Background: White
```

Focus:

```text
Border: Navy
Outline: subtle Golden
```

Labels must always be visible.

Do not rely only on placeholders.

---

# 56. Form Error State

Example:

```text
Phone Number

[ 017XXXXXXXX ]

Please enter a valid phone number.
```

Error message should be directly connected to the relevant field.

---

# 57. Success State

After inquiry:

```text
✓

Your inquiry has been submitted.

Reference:
INQ-2026-001245

Our team will contact you shortly.

[ Back to Home ]
```

---

# 58. Empty State

Tour search with no results:

```text
No packages found.

Try changing your destination,
budget or travel type.

[ Reset Filters ]
```

---

# 59. Loading State

Use skeletons:

```text
████████████████
████████

████████████
```

Avoid full-page spinners unless absolutely necessary.

---

# 60. Desktop Responsive Behavior

At ≥1280px:

- Full navigation
- 3–4 column cards
- Large hero
- Wide content container
- Side inquiry cards
- Full footer columns

At 1440px+:

- Increase whitespace
- Do not stretch text lines excessively
- Keep content max-width around 1280–1440px

---

# 61. Tablet Responsive Behavior

At approximately 768–1024px:

- Navigation may collapse
- 2-column cards
- Hero height reduced
- Filters become drawer
- Side-by-side sections may stack

---

# 62. Mobile Responsive Behavior

At <768px:

- Single-column content
- 2-column small grids where appropriate
- Horizontal scrolling destination cards
- Collapsible filters
- Accordion itinerary
- Sticky contact CTA
- Simplified navigation
- Shorter forms

---

# 63. Breakpoint Strategy

Recommended:

```text
xs: 320px
sm: 480px
md: 768px
lg: 1024px
xl: 1280px
2xl: 1440px
```

Use CSS behavior rather than designing around specific devices only.

---

# 64. Accessibility

All components must support:

- Keyboard navigation
- Visible focus
- Proper labels
- Semantic HTML
- Accessible color contrast
- Screen-reader-friendly buttons
- Alt text
- Accessible accordion
- Accessible modal
- Error announcements

---

# 65. Iconography

Use a single consistent icon library.

Preferred style:

```text
Minimal
Rounded
Modern
2px visual weight
```

Icons should support:

- Travel
- Visa
- Ticket
- Location
- Calendar
- Users
- Phone
- WhatsApp
- Email
- Search
- Arrow
- Check
- Close

Do not mix five different icon styles.

---

# 66. Photography Direction

Photography should feel:

```text
Cinematic
Bright
Authentic
Premium
Destination-focused
Human
```

Preferred subjects:

- Destinations
- Travelers
- Families
- Couples
- Airports
- Hotels
- Cultural experiences
- Scenic locations

Avoid obviously artificial stock imagery wherever possible.

---

# 67. Image Treatment

Use:

- High-quality source images
- Proper cropping
- Consistent aspect ratios
- Subtle gradients for text overlays
- WebP/AVIF
- Responsive image sizes

Do not distort images.

---

# 68. Golden Accent Rules

Golden should highlight:

```text
Important words
CTA
Icons
Badges
Small borders
Active navigation
Decorative lines
```

Golden should NOT dominate:

```text
Large text blocks
Entire cards
Full-page backgrounds
Every button
Every icon
```

---

# 69. Premium Decorative System

Use subtle:

```text
Golden line
Small compass icon
Location pin
Flight path
Abstract travel contour
```

These can appear as background decorations.

Opacity should remain low.

---

# 70. Section Heading Pattern

Standard:

```text
SMALL GOLD LABEL

Featured Tour Packages

Discover journeys designed
for your next adventure.
```

Example:

```text
FEATURED TOURS
Explore Our Most Popular Journeys
```

The small eyebrow label should use uppercase English or appropriate Bengali text.

---

# 71. Card Design System

All cards should share:

```text
Radius
Shadow
Border
Padding
Typography
CTA behavior
```

Avoid each section having a completely different card style.

---

# 72. CTA Hierarchy

Priority:

```text
Primary:
Get Started / Inquiry / Apply Now

Secondary:
Explore / View Details

Tertiary:
Learn More
```

Each section should have one obvious primary action.

---

# 73. Microinteractions

Use subtle interaction:

```text
Button:
100–180ms

Card:
180–250ms

Accordion:
200–300ms

Navigation:
150–200ms
```

Use CSS transitions where possible.

Avoid unnecessary JavaScript animation libraries.

---

# 74. Scroll Behavior

Smooth scrolling can be used for:

- Anchor navigation
- Section jumps

Do not hijack normal browser scrolling.

---

# 75. Accessibility Motion

Respect:

```text
prefers-reduced-motion
```

When enabled:

- Disable non-essential animation
- Reduce transitions
- Avoid parallax

---

# 76. Performance-Oriented Design

Design decisions must support performance.

Avoid:

- Background video by default
- Huge hero videos
- Heavy animation libraries
- Multiple external fonts
- Auto-playing media
- Large uncompressed images
- Excessive carousels

---

# 77. Image Loading Strategy

Hero:

```text
High priority
```

Above-the-fold images:

```text
Eager / prioritized where appropriate
```

Below-the-fold:

```text
Lazy
```

Gallery:

```text
Lazy
```

---

# 78. Component Naming

Use predictable naming.

Examples:

```text
Navbar
HeroSection
ServiceCard
TourCard
DestinationCard
VisaCard
OfferCard
TestimonialCard
BlogCard
FAQAccordion
InquiryForm
VisaApplicationForm
GalleryGrid
Footer
```

---

# 79. Public Page Layout Template

Every major page should follow:

```text
Header
↓
Page Hero
↓
Breadcrumb
↓
Main Content
↓
Supporting Content
↓
CTA
↓
Footer
```

Do not force this exact structure where it harms UX.

---

# 80. Breadcrumb Design

Example:

```text
Home
/
Tour Packages
/
Thailand Escape
```

Desktop:

Inline.

Mobile:

Compact and horizontally scrollable if necessary.

---

# 81. SEO-Friendly Visual Hierarchy

Every page must have:

```text
One H1
↓
H2 sections
↓
H3 subsections
```

Do not use headings solely for visual styling.

---

# 82. Admin Design Direction

The admin dashboard should NOT look identical to the public website.

Public:

```text
Premium Travel
```

Admin:

```text
Clean SaaS Dashboard
```

Use:

- Sidebar
- Topbar
- Data tables
- Filters
- Forms
- Status badges
- Charts
- Modals

---

# 83. Admin Color System

Primary:

```text
Navy
```

Accent:

```text
Golden
```

Background:

```text
#F5F7FA
```

Cards:

```text
White
```

Status colors should remain semantic:

```text
Success
Warning
Error
Info
```

Do not use gold for every status.

---

# 84. Admin Sidebar

```text
Dashboard

Travel
  Tours
  Destinations

Visa
  Countries
  Visa Types
  Applications

Requests
  Tour Inquiries
  Ticket Requests
  Contact Messages

Content
  Blog
  Gallery
  Testimonials
  FAQ
  Offers

Website
  Pages
  Homepage
  SEO
  Media

System
  Users
  Roles
  Settings
  Activity Logs
```

---

# 85. Admin Data Table

Columns should remain practical.

Example:

```text
Tour
Destination
Price
Status
Featured
Updated
Actions
```

Actions:

```text
View
Edit
Duplicate
Delete
```

Delete requires confirmation.

---

# 86. Admin Status Badges

Examples:

```text
Published
Draft
Active
Inactive
Pending
Processing
Completed
Cancelled
```

Use compact pill badges.

---

# 87. Admin Forms

Large forms should use sections:

```text
Basic Information
Pricing
Itinerary
Inclusions
Exclusions
Media
SEO
Publishing
```

Use sticky save controls on long pages if useful.

---

# 88. Tour Editor

Recommended:

```text
Tour Information
↓
Destination
↓
Category
↓
Duration
↓
Pricing
↓
Gallery
↓
Itinerary
↓
Includes
↓
Excludes
↓
FAQ
↓
SEO
↓
Publish
```

---

# 89. Visa Editor

```text
Country
Visa Type
Description
Processing Time
Fees
Eligibility
Documents
Profession Requirements
Process
Important Notes
FAQ
SEO
Status
```

---

# 90. Homepage Editor

Drag-and-drop ordering is optional.

Minimum:

```text
Enable
Disable
Order
Edit Content
Select Items
```

Sections:

```text
Hero
Services
Featured Tours
Destinations
Visa
Offers
Why Us
Process
Testimonials
Blog
FAQ
CTA
```

---

# 91. Dark Mode

Public website:

**Not required for MVP.**

The premium Navy + Gold system already provides a strong dark visual language.

Admin dashboard:

Optional.

---

# 92. Localization

Architecture should be future-ready for:

```text
English
Bengali
```

MVP can launch with one primary language, but database/content architecture should not prevent multilingual expansion.

---

# 93. Currency

Primary:

```text
BDT (৳)
```

Architecture should be ready for:

```text
USD
EUR
GBP
AED
```

Future implementation.

---

# 94. Content Tone

Public website copy should be:

```text
Clear
Professional
Warm
Confident
Concise
Customer-focused
```

Avoid:

```text
Overpromising
Fake urgency
Guaranteed visa language
Unverified claims
Excessive marketing clichés
```

---

# 95. Photography + Copy Balance

Do not allow imagery to overwhelm information.

Recommended:

```text
40% Visual
60% Information / whitespace
```

For hero:

```text
60% Visual
40% Content
```

For destination cards:

```text
70% Visual
30% Text
```

---

# 96. Mobile Content Priority

On mobile prioritize:

```text
1. Brand
2. Page title
3. Primary action
4. Core information
5. Supporting information
6. Secondary links
```

Long information should become:

- Accordion
- Tabs
- Collapsible sections

where appropriate.

---

# 97. Mobile Tour Card

```text
┌───────────────────────┐
│       IMAGE           │
├───────────────────────┤
│ Thailand Escape       │
│ 5D / 4N               │
│                       │
│ From ৳XX,XXX          │
│                       │
│ [ View Details ]      │
└───────────────────────┘
```

---

# 98. Mobile Visa Card

```text
┌───────────────────────┐
│ 🇹🇭 Thailand           │
│ Tourist Visa          │
│                       │
│ Processing: X days    │
│                       │
│ View Details →        │
└───────────────────────┘
```

---

# 99. Mobile Inquiry UX

Forms should be short.

First ask:

```text
What do you need?
```

Then dynamically reveal:

```text
Tour
Visa
Air Ticket
Custom Trip
```

This reduces cognitive load.

---

# 100. Conversion Principle

Every major page must answer:

### What is this?

### Why should I care?

### What should I do next?

The UI should make the answer visually obvious.

---

# 101. Design Quality Checklist

## Visual

- [ ] Navy + Gold identity consistent
- [ ] Typography consistent
- [ ] Spacing consistent
- [ ] Cards consistent
- [ ] Buttons consistent
- [ ] Image ratios consistent
- [ ] No unnecessary visual clutter

## UX

- [ ] Clear navigation
- [ ] Clear CTAs
- [ ] Short inquiry flows
- [ ] Mobile-friendly
- [ ] Useful filtering
- [ ] Clear information hierarchy

## Accessibility

- [ ] Contrast checked
- [ ] Keyboard navigation
- [ ] Labels
- [ ] Focus states
- [ ] Alt text
- [ ] Reduced motion

## Performance

- [ ] Optimized images
- [ ] Minimal animation
- [ ] Minimal JS
- [ ] Lazy loading
- [ ] Responsive images
- [ ] No unnecessary third-party resources

---

# 102. Final Design System Summary

```text
BRAND
Navy + Golden

TYPOGRAPHY
Poppins + Hind Siliguri

STYLE
Premium + Clean + Corporate Travel

LAYOUT
12-column desktop
8-column tablet
4-column mobile concept

CARDS
12–16px radius

BUTTONS
48–52px height

SECTIONS
48–120px spacing

IMAGERY
Cinematic + Destination-focused

ANIMATION
Subtle + Performance-friendly

NAVIGATION
Simple + Conversion-focused

MOBILE
First-class experience

ADMIN
Clean SaaS dashboard

SEO
Semantic + Content-first
```

---

# 103. Final Design Principle

The website should look like a brand that says:

> **“We know travel, we respect your time, and we make the complicated parts easier.”**

It should NOT look like:

> “Here are 50 random tour packages. Please call us.”

The final experience should be:

```text
DISCOVER
    ↓
TRUST
    ↓
EXPLORE
    ↓
UNDERSTAND
    ↓
INQUIRE
    ↓
CONVERT
```

---

# END OF DESIGN.md