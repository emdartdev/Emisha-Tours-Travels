# WIREFRAME.md

## Premium Travel Agency Website — Wireframe & UX Structure

**Project Type:** Premium Online Travel Agency + Visa Consultancy + Air Ticketing Platform  
**Primary Reference:** Travel Tracker BD  
**Tech Stack:** Laravel + MySQL + Vue.js  
**Rendering:** Blade SSR + Selective Vue  
**Admin:** Vue.js + Laravel  
**Primary Market:** Bangladesh  
**Primary Brand Colors:** Navy Blue + Golden + Dark Grey

---

# 1. Wireframe Philosophy

The website must be designed around the following conversion journey:

> **Trust → Discover → Compare → Inquire → Consult → Convert**

The wireframe must prioritize:

- Clear information hierarchy
- Fast destination discovery
- Tour package discovery
- Visa service discovery
- Air ticket inquiry
- WhatsApp/contact conversion
- Mobile usability
- SEO-friendly content structure
- Trust-building
- Low cognitive load
- Clear CTAs
- Short inquiry flows

The website must **not** feel like a generic travel template.

It should feel like:

> **A premium, reliable, modern Bangladeshi travel consultancy platform.**

---

# 2. Global Layout

## Desktop

```text
┌──────────────────────────────────────────────────────────────┐
│ TOP BAR                                                      │
│ Phone | WhatsApp | Email | Office Hours                     │
├──────────────────────────────────────────────────────────────┤
│ LOGO       Home  Tours  Visa  Air Ticket  Destinations  ... │
│                                      [Get Consultation]      │
├──────────────────────────────────────────────────────────────┤
│                                                              │
│                        PAGE CONTENT                          │
│                                                              │
├──────────────────────────────────────────────────────────────┤
│ FOOTER                                                       │
└──────────────────────────────────────────────────────────────┘
```

## Tablet

```text
┌──────────────────────────────────────────────┐
│ Logo                    ☰                    │
├──────────────────────────────────────────────┤
│                                              │
│                PAGE CONTENT                  │
│                                              │
├──────────────────────────────────────────────┤
│ Footer                                       │
└──────────────────────────────────────────────┘
```

## Mobile

```text
┌────────────────────────────┐
│ Logo                 ☰     │
├────────────────────────────┤
│                            │
│      PAGE CONTENT          │
│                            │
│                            │
├────────────────────────────┤
│ WhatsApp | Call | Inquiry  │
└────────────────────────────┘
```

---

# 3. Global Header Wireframe

## 3.1 Top Bar

Desktop:

```text
┌──────────────────────────────────────────────────────────────┐
│ ✆ +880 XXX XXXXXXX   WhatsApp   ✉ info@example.com           │
│                                      Sun–Thu: 9AM–8PM         │
└──────────────────────────────────────────────────────────────┘
```

Purpose:

- Establish legitimacy
- Make contact information immediately accessible
- Support direct conversion

Mobile:

```text
┌────────────────────────────┐
│ WhatsApp      Call         │
└────────────────────────────┘
```

---

# 4. Main Navigation

Desktop:

```text
┌──────────────────────────────────────────────────────────────┐
│ [LOGO]                                                       │
│                                                              │
│ Home | Tours | Visa | Air Ticket | Destinations | Blog       │
│                                                              │
│                         [Contact / Inquiry]                   │
└──────────────────────────────────────────────────────────────┘
```

Recommended navigation:

- Home
- Tour Packages
- Visa Services
- Air Ticketing
- Destinations
- Travel Guide
- About Us
- Contact

Optional:

- Offers

The navigation must remain visually clean.

Avoid:

- Mega-menu overload
- Too many menu items
- Excessive dropdown nesting

---

# 5. Homepage Wireframe

## 5.1 Hero Section

The hero is the most important conversion area.

```text
┌──────────────────────────────────────────────────────────────┐
│                                                              │
│                 FULL-WIDTH TRAVEL IMAGE                      │
│             Dark Navy Overlay / Gradient                     │
│                                                              │
│          YOUR JOURNEY STARTS HERE                            │
│                                                              │
│       Explore the World With Confidence                      │
│                                                              │
│   Discover tours, visa assistance & air ticketing             │
│                                                              │
│  ┌───────────────────────────────────────────────────────┐   │
│  │ Tour Packages | Visa Assistance | Air Ticket          │   │
│  ├───────────────────────────────────────────────────────┤   │
│  │ 🔍 Where do you want to go?                           │   │
│  │                                                       │   │
│  │ [Destination] [Travel Date] [Travelers] [Search]     │   │
│  └───────────────────────────────────────────────────────┘   │
│                                                              │
│      [Explore Tours]        [Visa Assistance]                │
│                                                              │
└──────────────────────────────────────────────────────────────┘
```

### Hero content hierarchy

1. Eyebrow
2. H1
3. Supporting text
4. Search/inquiry widget
5. Primary CTA
6. Secondary CTA

Do not use:

- Multiple rotating hero slides
- Excessive text
- Large video backgrounds
- Too many buttons

---

# 6. Quick Services

Immediately below hero.

```text
┌──────────────────────────────────────────────────────────────┐
│                     OUR SERVICES                             │
│            Everything You Need For Your Journey              │
│                                                              │
│ ┌──────────────┐ ┌──────────────┐ ┌──────────────┐          │
│ │ ✈            │ │ 🛂           │ │ 🎫           │          │
│ │ Tour         │ │ Visa         │ │ Air          │          │
│ │ Packages     │ │ Assistance   │ │ Ticketing    │          │
│ │              │ │              │ │              │          │
│ │ Explore →    │ │ Apply →      │ │ Request →    │          │
│ └──────────────┘ └──────────────┘ └──────────────┘          │
└──────────────────────────────────────────────────────────────┘
```

Cards should be simple and premium.

---

# 7. Featured Tour Packages

```text
┌──────────────────────────────────────────────────────────────┐
│ FEATURED TOURS                         [View All Tours →]     │
│                                                              │
│        Explore Our Popular Travel Experiences                │
│                                                              │
│ ┌────────────────┐ ┌────────────────┐ ┌────────────────┐    │
│ │                │ │                │ │                │    │
│ │    IMAGE       │ │    IMAGE       │ │    IMAGE       │    │
│ │                │ │                │ │                │    │
│ ├────────────────┤ ├────────────────┤ ├────────────────┤    │
│ │ Thailand       │ │ Maldives       │ │ Dubai          │    │
│ │ 5 Days / 4 N   │ │ 4 Days / 3 N   │ │ 5 Days / 4 N   │    │
│ │ From ৳XX,XXX   │ │ From ৳XX,XXX   │ │ From ৳XX,XXX   │    │
│ │ [View Details] │ │ [View Details] │ │ [View Details] │    │
│ └────────────────┘ └────────────────┘ └────────────────┘    │
└──────────────────────────────────────────────────────────────┘
```

Tour cards must expose:

- Destination
- Package title
- Duration
- Starting price
- Important highlights
- CTA

---

# 8. Popular Destinations

```text
┌──────────────────────────────────────────────────────────────┐
│ POPULAR DESTINATIONS                                         │
│                                                              │
│ ┌──────────────────┐ ┌──────────────────┐                   │
│ │                  │ │                  │                   │
│ │      IMAGE       │ │      IMAGE       │                   │
│ │                  │ │                  │                   │
│ │    Thailand      │ │     Maldives     │                   │
│ └──────────────────┘ └──────────────────┘                   │
│                                                              │
│ ┌──────────────────┐ ┌──────────────────┐                   │
│ │      Dubai       │ │     Malaysia     │                   │
│ └──────────────────┘ └──────────────────┘                   │
│                                                              │
│                         [Explore Destinations]                │
└──────────────────────────────────────────────────────────────┘
```

Destination cards should prioritize imagery.

---

# 9. Visa Services Section

```text
┌──────────────────────────────────────────────────────────────┐
│ VISA SERVICES                         [View All Visa →]       │
│                                                              │
│        Visa Assistance Made Simpler                          │
│                                                              │
│ ┌─────────────────────────────────────────────────────────┐ │
│ │ 🔎 Search Country / Visa Type                            │ │
│ └─────────────────────────────────────────────────────────┘ │
│                                                              │
│ ┌──────────────┐ ┌──────────────┐ ┌──────────────┐           │
│ │ 🇹🇭          │ │ 🇦🇪          │ │ 🇲🇾          │           │
│ │ Thailand     │ │ UAE          │ │ Malaysia     │           │
│ │ Tourist Visa │ │ Tourist Visa │ │ Tourist Visa │           │
│ │ [Details →]  │ │ [Details →]  │ │ [Details →]  │           │
│ └──────────────┘ └──────────────┘ └──────────────┘           │
└──────────────────────────────────────────────────────────────┘
```

Optional additional filters:

- Tourist
- Business
- Student
- Medical
- Family
- E-Visa

---

# 10. Exclusive Offers

```text
┌──────────────────────────────────────────────────────────────┐
│                         EXCLUSIVE OFFER                       │
│                                                              │
│ ┌──────────────────────────┐ ┌────────────────────────────┐ │
│ │                          │ │                            │ │
│ │       LARGE IMAGE        │ │  SPECIAL TRAVEL OFFER      │ │
│ │                          │ │                            │ │
│ │                          │ │  Destination               │ │
│ │                          │ │  Validity                  │ │
│ │                          │ │  From ৳XX,XXX              │ │
│ │                          │ │                            │ │
│ │                          │ │  [Explore Offer]            │ │
│ └──────────────────────────┘ └────────────────────────────┘ │
└──────────────────────────────────────────────────────────────┘
```

Only display genuine offers.

---

# 11. Why Choose Us

```text
┌──────────────────────────────────────────────────────────────┐
│ WHY CHOOSE US                                                 │
│                                                              │
│              Travel With Confidence                          │
│                                                              │
│ ┌──────────────┐ ┌──────────────┐ ┌──────────────┐           │
│ │ ✓            │ │ ✓            │ │ ✓            │           │
│ │ Expert       │ │ Transparent  │ │ Personalized │           │
│ │ Assistance   │ │ Process      │ │ Support      │           │
│ └──────────────┘ └──────────────┘ └──────────────┘           │
│                                                              │
│ ┌──────────────┐ ┌──────────────┐                            │
│ │ ✓            │ │ ✓            │                            │
│ │ End-to-End   │ │ Travel       │                            │
│ │ Support      │ │ Guidance     │                            │
│ └──────────────┘ └──────────────┘                            │
└──────────────────────────────────────────────────────────────┘
```

Do not use fake statistics.

---

# 12. How It Works

```text
┌──────────────────────────────────────────────────────────────┐
│ HOW IT WORKS                                                  │
│                                                              │
│  01                 02                 03                 04 │
│  ●──────────────────●──────────────────●──────────────────● │
│                                                              │
│ Tell Us           Get Guidance       Confirm           Travel │
│ Your Plan         & Options          Your Plan         Happy  │
│                                                              │
└──────────────────────────────────────────────────────────────┘
```

Mobile:

```text
01 Tell Us Your Plan
       ↓
02 Get Guidance
       ↓
03 Confirm Your Plan
       ↓
04 Travel
```

---

# 13. Customized Trip CTA

```text
┌──────────────────────────────────────────────────────────────┐
│                                                              │
│       YOUR TRIP. YOUR WAY.                                   │
│                                                              │
│     Can't find the right package?                            │
│     Let us build a trip around your needs.                   │
│                                                              │
│                 [Plan My Trip →]                             │
│                                                              │
└──────────────────────────────────────────────────────────────┘
```

---

# 14. Testimonials

```text
┌──────────────────────────────────────────────────────────────┐
│                     CLIENT STORIES                            │
│                                                              │
│ ┌──────────────────────────────────────────────────────────┐ │
│ │ ★★★★★                                                    │ │
│ │                                                          │ │
│ │ "Customer testimonial..."                                │ │
│ │                                                          │ │
│ │ [Photo] Client Name                                      │ │
│ │        Trip / Service                                    │ │
│ └──────────────────────────────────────────────────────────┘ │
│                                                              │
│                       ● ○ ○                                  │
└──────────────────────────────────────────────────────────────┘
```

Only publish genuine testimonials.

---

# 15. Travel Guide / Blog

```text
┌──────────────────────────────────────────────────────────────┐
│ TRAVEL GUIDE                              [View All →]        │
│                                                              │
│ ┌────────────────┐ ┌────────────────┐ ┌────────────────┐    │
│ │     IMAGE      │ │     IMAGE      │ │     IMAGE      │    │
│ ├────────────────┤ ├────────────────┤ ├────────────────┤    │
│ │ Thailand Visa  │ │ Dubai Guide    │ │ Maldives Guide │    │
│ │ 8 min read     │ │ 6 min read     │ │ 7 min read     │    │
│ │ [Read →]       │ │ [Read →]       │ │ [Read →]       │    │
│ └────────────────┘ └────────────────┘ └────────────────┘    │
└──────────────────────────────────────────────────────────────┘
```

Purpose:

- SEO
- Education
- Organic traffic
- Trust
- Internal linking
- Conversion support

---

# 16. FAQ

```text
┌──────────────────────────────────────────────────────────────┐
│ FREQUENTLY ASKED QUESTIONS                                   │
│                                                              │
│ ┌──────────────────────────────────────────────────────────┐ │
│ │ + How do I book a tour?                                  │ │
│ ├──────────────────────────────────────────────────────────┤ │
│ │ + What documents are required for a visa?                │ │
│ ├──────────────────────────────────────────────────────────┤ │
│ │ + How can I request an air ticket fare?                  │ │
│ ├──────────────────────────────────────────────────────────┤ │
│ │ + What is your cancellation policy?                      │ │
│ └──────────────────────────────────────────────────────────┘ │
│                                                              │
│                         [View FAQ →]                          │
└──────────────────────────────────────────────────────────────┘
```

Accordion interaction:

- One or multiple open states
- Keyboard accessible
- Vue enhancement only where necessary

---

# 17. Final CTA

```text
┌──────────────────────────────────────────────────────────────┐
│                                                              │
│             READY FOR YOUR NEXT JOURNEY?                     │
│                                                              │
│      Tell us where you want to go.                           │
│      We'll help you plan the next step.                      │
│                                                              │
│       [Start Your Inquiry]    [WhatsApp Us]                  │
│                                                              │
└──────────────────────────────────────────────────────────────┘
```

---

# 18. Footer Wireframe

```text
┌──────────────────────────────────────────────────────────────┐
│                                                              │
│ [LOGO]                                                       │
│                                                              │
│ Premium travel assistance for tours, visas & air ticketing.  │
│                                                              │
│ COMPANY              SERVICES             INFORMATION         │
│ About Us             Tour Packages       Blog                │
│ Contact              Visa Services       FAQ                 │
│ Gallery              Air Ticketing       Privacy Policy      │
│ Destinations         Customized Trips    Terms               │
│                                                              │
│ CONTACT                                                       │
│ Phone | WhatsApp | Email | Address                           │
│                                                              │
├──────────────────────────────────────────────────────────────┤
│ © 2026 Company Name. All Rights Reserved.                    │
│                                                              │
│ Privacy | Terms | Refund Policy | Visa Disclaimer             │
└──────────────────────────────────────────────────────────────┘
```

---

# 19. Tour Listing Page

URL:

```text
/tours
```

Wireframe:

```text
┌──────────────────────────────────────────────────────────────┐
│ Breadcrumb                                                    │
│ Home / Tours                                                  │
│                                                              │
│ TOUR PACKAGES                                                 │
│ Explore Our Travel Experiences                               │
│                                                              │
│ ┌──────────────────────────────────────────────────────────┐ │
│ │ Search tours...                              🔍           │ │
│ └──────────────────────────────────────────────────────────┘ │
│                                                              │
│ Category: [All] [International] [Domestic] [Honeymoon] ... │
│                                                              │
│ ┌──────────────┐ ┌───────────────────────────────────────┐ │
│ │ FILTERS      │ │ TOUR GRID                             │ │
│ │              │ │                                       │ │
│ │ Destination  │ │ ┌────────┐ ┌────────┐ ┌────────┐     │ │
│ │ Duration     │ │ │ Tour   │ │ Tour   │ │ Tour   │     │ │
│ │ Price        │ │ │ Card   │ │ Card   │ │ Card   │     │ │
│ │ Tour Type    │ │ └────────┘ └────────┘ └────────┘     │ │
│ │              │ │                                       │ │
│ │ [Apply]      │ │ ┌────────┐ ┌────────┐ ┌────────┐     │ │
│ └──────────────┘ │ │ Tour   │ │ Tour   │ │ Tour   │     │ │
│                  │ └────────┘ └────────┘ └────────┘     │ │
└──────────────────────────────────────────────────────────────┘
```

Mobile:

```text
┌────────────────────────────┐
│ Tour Packages              │
│                            │
│ [ Search Tours... ]        │
│                            │
│ [Filter] [Sort]            │
│                            │
│ ┌────────────────────────┐ │
│ │       Tour Image       │ │
│ ├────────────────────────┤ │
│ │ Thailand Tour          │ │
│ │ 5 Days / 4 Nights      │ │
│ │ From ৳XX,XXX           │ │
│ │ [View Details]         │ │
│ └────────────────────────┘ │
└────────────────────────────┘
```

---

# 20. Tour Detail Page

URL:

```text
/tours/{slug}
```

Wireframe:

```text
┌──────────────────────────────────────────────────────────────┐
│ Breadcrumb                                                    │
│                                                              │
│ ┌──────────────────────────────────────────────────────────┐ │
│ │                    HERO IMAGE                            │ │
│ └──────────────────────────────────────────────────────────┘ │
│                                                              │
│ Thailand Holiday Package                                    │
│ 5 Days / 4 Nights                                           │
│                                                              │
│ From ৳XX,XXX                          [Request This Tour]     │
│                                                              │
├──────────────────────────────────────────────────────────────┤
│ Overview | Itinerary | Includes | Excludes | FAQ             │
├──────────────────────────────────────────────────────────────┤
│                                                              │
│ OVERVIEW                                                     │
│                                                              │
│ Description...                                               │
│                                                              │
├──────────────────────────────────────────────────────────────┤
│ TOUR HIGHLIGHTS                                              │
│ ✓ Highlight 1    ✓ Highlight 2    ✓ Highlight 3             │
├──────────────────────────────────────────────────────────────┤
│ ITINERARY                                                    │
│                                                              │
│ Day 01 ─────────────────────────────────────                 │
│ Arrival & transfer                                           │
│                                                              │
│ Day 02 ─────────────────────────────────────                 │
│ City tour                                                    │
│                                                              │
│ Day 03 ─────────────────────────────────────                 │
│ Activity                                                     │
├──────────────────────────────────────────────────────────────┤
│ INCLUDED                                                     │
│ ✓ Hotel                                                      │
│ ✓ Breakfast                                                  │
│ ✓ Transportation                                             │
│                                                              │
│ NOT INCLUDED                                                 │
│ ✕ Personal expenses                                          │
│ ✕ Visa fee                                                   │
├──────────────────────────────────────────────────────────────┤
│ IMPORTANT INFORMATION                                        │
│                                                              │
│ Cancellation / booking notes                                 │
├──────────────────────────────────────────────────────────────┤
│ FAQ                                                          │
├──────────────────────────────────────────────────────────────┤
│                    [REQUEST THIS TOUR]                       │
└──────────────────────────────────────────────────────────────┘
```

Mobile should use a sticky bottom CTA.

---

# 21. Destination Listing Page

URL:

```text
/destinations
```

```text
┌──────────────────────────────────────────────────────────────┐
│ DESTINATIONS                                                 │
│                                                              │
│ [ Search Destination... ]                                    │
│                                                              │
│ ┌──────────────┐ ┌──────────────┐ ┌──────────────┐           │
│ │    IMAGE     │ │    IMAGE     │ │    IMAGE     │           │
│ │   Thailand   │ │   Maldives   │ │    Dubai     │           │
│ └──────────────┘ └──────────────┘ └──────────────┘           │
│                                                              │
│ ┌──────────────┐ ┌──────────────┐ ┌──────────────┐           │
│ │   Malaysia   │ │   Singapore  │ │   Turkey     │           │
│ └──────────────┘ └──────────────┘ └──────────────┘           │
└──────────────────────────────────────────────────────────────┘
```

---

# 22. Destination Detail Page

URL:

```text
/destinations/{slug}
```

```text
┌──────────────────────────────────────────────────────────────┐
│ HERO IMAGE                                                    │
│                                                              │
│                    THAILAND                                  │
│                 Explore Thailand                             │
├──────────────────────────────────────────────────────────────┤
│ About Destination                                            │
│                                                              │
│ Destination content...                                       │
├──────────────────────────────────────────────────────────────┤
│ POPULAR PLACES                                               │
│                                                              │
│ [Place] [Place] [Place]                                     │
├──────────────────────────────────────────────────────────────┤
│ BEST TIME TO VISIT                                           │
├──────────────────────────────────────────────────────────────┤
│ TOUR PACKAGES                                                │
├──────────────────────────────────────────────────────────────┤
│ VISA INFORMATION                                             │
├──────────────────────────────────────────────────────────────┤
│ TRAVEL TIPS                                                  │
├──────────────────────────────────────────────────────────────┤
│ FAQ                                                          │
├──────────────────────────────────────────────────────────────┤
│             [PLAN YOUR TRIP]                                 │
└──────────────────────────────────────────────────────────────┘
```

---

# 23. Visa Listing Page

URL:

```text
/visa
```

```text
┌──────────────────────────────────────────────────────────────┐
│ VISA SERVICES                                                 │
│                                                              │
│ Find Visa Assistance                                        │
│                                                              │
│ ┌──────────────────────────────────────────────────────────┐ │
│ │ Search Country...                                        │ │
│ └──────────────────────────────────────────────────────────┘ │
│                                                              │
│ [Tourist] [Business] [Student] [Medical] [Family] [E-Visa] │
│                                                              │
│ ┌──────────────┐ ┌──────────────┐ ┌──────────────┐           │
│ │ Thailand     │ │ UAE          │ │ Malaysia     │           │
│ │ Tourist Visa │ │ Tourist Visa │ │ Tourist Visa │           │
│ │ [Details]    │ │ [Details]    │ │ [Details]    │           │
│ └──────────────┘ └──────────────┘ └──────────────┘           │
└──────────────────────────────────────────────────────────────┘
```

---

# 24. Visa Detail Page

URL:

```text
/visa/{slug}
```

```text
┌──────────────────────────────────────────────────────────────┐
│ Breadcrumb                                                    │
│                                                              │
│ Thailand Tourist Visa                                        │
│                                                              │
│ Processing Time: X–X Days*                                   │
│ Starting Fee: ৳XX,XXX*                                      │
│                                                              │
│                  [Apply for Visa]                            │
├──────────────────────────────────────────────────────────────┤
│ VISA OVERVIEW                                                │
├──────────────────────────────────────────────────────────────┤
│ ELIGIBILITY                                                  │
├──────────────────────────────────────────────────────────────┤
│ REQUIRED DOCUMENTS                                           │
│                                                              │
│ □ Passport                                                   │
│ □ Photograph                                                 │
│ □ Bank Statement                                             │
│ □ Employment Documents                                       │
│ □ Other                                                      │
├──────────────────────────────────────────────────────────────┤
│ PROFESSION-BASED CHECKLIST                                   │
│                                                              │
│ [Salaried] [Business] [Student] [Freelancer] ...             │
├──────────────────────────────────────────────────────────────┤
│ APPLICATION PROCESS                                          │
│                                                              │
│ 01 → 02 → 03 → 04                                           │
├──────────────────────────────────────────────────────────────┤
│ IMPORTANT NOTES                                              │
├──────────────────────────────────────────────────────────────┤
│ FAQ                                                          │
├──────────────────────────────────────────────────────────────┤
│                                                              │
│ Visa approval is determined solely by the relevant authority.│
│                                                              │
│                  [START APPLICATION]                         │
└──────────────────────────────────────────────────────────────┘
```

Use:

`*Information is subject to change. Please confirm current requirements before application.`

---

# 25. Visa Application Wizard

URL:

```text
/visa/apply
```

Desktop:

```text
┌──────────────────────────────────────────────────────────────┐
│ VISA APPLICATION                                             │
│                                                              │
│ ① Applicant → ② Travel → ③ Documents → ④ Review → ⑤ Submit│
├──────────────────────────────────────────────────────────────┤
│                                                              │
│ APPLICANT INFORMATION                                        │
│                                                              │
│ Full Name        [____________________]                     │
│ Phone            [____________________]                     │
│ Email            [____________________]                     │
│ Date of Birth    [____________________]                     │
│ Profession       [ Select Profession ▼ ]                    │
│                                                              │
│                              [Continue →]                    │
└──────────────────────────────────────────────────────────────┘
```

### Step 2

```text
TRAVEL INFORMATION

Destination       [___________]
Visa Type         [___________]
Travel Date       [___________]
Return Date       [___________]
Travelers         [___________]

[← Back] [Continue →]
```

### Step 3

```text
DOCUMENT UPLOAD

Passport          [Upload]
Photograph        [Upload]
Bank Statement    [Upload]
Additional Docs   [Upload]

Accepted: PDF/JPG/PNG
Maximum file size: configurable

[← Back] [Continue →]
```

### Step 4

```text
REVIEW APPLICATION

Applicant ✓
Travel ✓
Documents ✓

[Edit] [Edit] [Edit]

☐ I confirm the information is accurate.

[Submit Application]
```

### Step 5

```text
┌────────────────────────────────────────────┐
│             APPLICATION RECEIVED            │
│                                            │
│ Reference No: VISA-2026-XXXX               │
│                                            │
│ We have received your application.         │
│                                            │
│ [Track Application] [WhatsApp Us]          │
└────────────────────────────────────────────┘
```

Sensitive documents must never be publicly accessible.

---

# 26. Air Ticketing Page

URL:

```text
/air-ticketing
```

```text
┌──────────────────────────────────────────────────────────────┐
│ AIR TICKETING                                                 │
│                                                              │
│ Book Your Flight With Expert Assistance                      │
│                                                              │
│ [Round Trip] [One Way] [Multi City]                          │
│                                                              │
│ From               To                                        │
│ [___________]      [___________]                             │
│                                                              │
│ Departure Date     Return Date                               │
│ [___________]      [___________]                             │
│                                                              │
│ Adults [2] Children [0] Infants [0]                          │
│                                                              │
│ Cabin Class [Economy ▼]                                      │
│ Airline Preference [Optional]                               │
│                                                              │
│ Additional Requirements                                      │
│ [____________________________________________________]       │
│                                                              │
│                     [REQUEST FARE]                           │
└──────────────────────────────────────────────────────────────┘
```

Below:

```text
Why Request Through Us?
✓ Fare assistance
✓ Booking support
✓ Reissue assistance*
✓ Refund assistance*
✓ Group booking assistance*
```

Only show services actually provided.

---

# 27. Customized Trip Page

URL:

```text
/custom-trip
```

```text
┌──────────────────────────────────────────────────────────────┐
│ BUILD YOUR CUSTOM TRIP                                        │
│                                                              │
│ Tell us what you have in mind.                               │
│                                                              │
│ Destination       [________________]                         │
│ Travel Date       [________________]                         │
│ Duration          [________________]                         │
│ Travelers         [________________]                         │
│ Budget            [________________]                         │
│ Tour Type         [Select ▼]                                 │
│ Hotel Preference  [Select ▼]                                 │
│                                                              │
│ Special Requirements                                         │
│ [____________________________________________________]       │
│                                                              │
│ Phone             [________________]                         │
│ Email             [________________]                         │
│                                                              │
│                    [SEND REQUEST]                            │
└──────────────────────────────────────────────────────────────┘
```

---

# 28. Contact Page

URL:

```text
/contact
```

```text
┌──────────────────────────────────────────────────────────────┐
│ CONTACT US                                                    │
│                                                              │
│ ┌──────────────────────┐ ┌────────────────────────────────┐ │
│ │ CONTACT INFORMATION  │ │ SEND US A MESSAGE              │ │
│ │                      │ │                                │ │
│ │ Phone                │ │ Name                           │ │
│ │ WhatsApp             │ │ Phone                          │ │
│ │ Email                │ │ Email                          │ │
│ │ Address              │ │ Service                        │ │
│ │ Business Hours       │ │ Travel Date                    │ │
│ │                      │ │ Message                        │ │
│ │                      │ │                                │ │
│ │                      │ │ [SEND MESSAGE]                 │ │
│ └──────────────────────┘ └────────────────────────────────┘ │
│                                                              │
│                         GOOGLE MAP                           │
└──────────────────────────────────────────────────────────────┘
```

---

# 29. Gallery Page

URL:

```text
/gallery
```

```text
┌──────────────────────────────────────────────────────────────┐
│ GALLERY                                                       │
│                                                              │
│ [All] [Tour Moments] [Client Moments] [Destinations]         │
│ [Group Tours] [Office] [Events]                              │
│                                                              │
│ ┌────────┐ ┌────────┐ ┌────────┐ ┌────────┐                 │
│ │ Image  │ │ Image  │ │ Image  │ │ Image  │                 │
│ ├────────┤ ├────────┤ ├────────┤ ├────────┤                 │
│ │ Image  │ │ Image  │ │ Image  │ │ Image  │                 │
│ └────────┘ └────────┘ └────────┘ └────────┘                 │
└──────────────────────────────────────────────────────────────┘
```

Click image:

```text
┌────────────────────────────────────────┐
│                                        │
│              LARGE IMAGE               │
│                                        │
│                             ×          │
└────────────────────────────────────────┘
```

Use accessible lightbox controls.

---

# 30. Blog Listing Page

URL:

```text
/blog
```

```text
┌──────────────────────────────────────────────────────────────┐
│ TRAVEL GUIDE                                                  │
│                                                              │
│ Search travel guides... 🔍                                  │
│                                                              │
│ FEATURED ARTICLE                                             │
│ ┌──────────────────────────────────────────────────────────┐ │
│ │                    IMAGE                                 │ │
│ │                                                          │ │
│ │ Thailand Visa Guide                                      │ │
│ │ Everything you need to know...                           │ │
│ │ [Read Article →]                                         │ │
│ └──────────────────────────────────────────────────────────┘ │
│                                                              │
│ LATEST ARTICLES                                              │
│                                                              │
│ ┌────────┐ ┌────────┐ ┌────────┐                            │
│ │ Image  │ │ Image  │ │ Image  │                            │
│ │ Article│ │ Article│ │ Article│                            │
│ └────────┘ └────────┘ └────────┘                            │
└──────────────────────────────────────────────────────────────┘
```

---

# 31. Blog Detail Page

URL:

```text
/blog/{slug}
```

```text
┌──────────────────────────────────────────────────────────────┐
│ Breadcrumb                                                    │
│                                                              │
│ ARTICLE TITLE                                                 │
│                                                              │
│ Published: Date | Updated: Date | X min read                 │
│                                                              │
│ ┌──────────────────────────────────────────────────────────┐ │
│ │                    FEATURED IMAGE                         │ │
│ └──────────────────────────────────────────────────────────┘ │
│                                                              │
│ ┌───────────────┐ ┌────────────────────────────────────────┐│
│ │ TABLE OF      │ │                                        ││
│ │ CONTENTS      │ │ ARTICLE CONTENT                        ││
│ │               │ │                                        ││
│ │ 01 ...        │ │ H2                                     ││
│ │ 02 ...        │ │ Paragraph...                           ││
│ │ 03 ...        │ │                                        ││
│ └───────────────┘ └────────────────────────────────────────┘│
│                                                              │
│ RELATED TOURS                                                 │
│                                                              │
│ RELATED VISA SERVICES                                        │
│                                                              │
│ RELATED ARTICLES                                             │
│                                                              │
│ [Start Your Inquiry]                                        │
└──────────────────────────────────────────────────────────────┘
```

---

# 32. FAQ Page

URL:

```text
/faq
```

```text
┌──────────────────────────────────────────────────────────────┐
│ FREQUENTLY ASKED QUESTIONS                                   │
│                                                              │
│ [Tour Booking] [Visa] [Air Ticket] [Payment] [Refund]        │
│                                                              │
│ ┌──────────────────────────────────────────────────────────┐ │
│ │ + Question                                                │ │
│ ├──────────────────────────────────────────────────────────┤ │
│ │ + Question                                                │ │
│ ├──────────────────────────────────────────────────────────┤ │
│ │ + Question                                                │ │
│ └──────────────────────────────────────────────────────────┘ │
└──────────────────────────────────────────────────────────────┘
```

---

# 33. About Us Page

URL:

```text
/about
```

```text
┌──────────────────────────────────────────────────────────────┐
│ HERO                                                         │
│ About [Company Name]                                         │
├──────────────────────────────────────────────────────────────┤
│ OUR STORY                                                    │
│                                                              │
│ Image                         Story                           │
├──────────────────────────────────────────────────────────────┤
│ OUR SERVICES                                                 │
├──────────────────────────────────────────────────────────────┤
│ OUR APPROACH                                                 │
├──────────────────────────────────────────────────────────────┤
│ WHY TRAVELERS CHOOSE US                                      │
├──────────────────────────────────────────────────────────────┤
│ TEAM / EXPERTISE                                             │
├──────────────────────────────────────────────────────────────┤
│ CTA                                                          │
└──────────────────────────────────────────────────────────────┘
```

Do not create unverifiable claims.

---

# 34. Legal Page Wireframe

Applies to:

```text
/privacy-policy
/terms-and-conditions
/refund-cancellation-policy
/visa-disclaimer
/cookie-policy
```

```text
┌──────────────────────────────────────────────────────────────┐
│ Breadcrumb                                                    │
│                                                              │
│ PAGE TITLE                                                    │
│ Last Updated: Date                                           │
├──────────────────────────────────────────────────────────────┤
│                                                              │
│ 1. Section                                                   │
│                                                              │
│ Content...                                                   │
│                                                              │
│ 2. Section                                                   │
│                                                              │
│ Content...                                                   │
│                                                              │
└──────────────────────────────────────────────────────────────┘
```

Legal pages should prioritize readability over decorative design.

---

# 35. Search / Filtering UX

## Tour Search

Fields:

```text
Destination
Category
Duration
Price Range
Travel Date
```

Desktop:

```text
┌──────────────────────────────────────────────────────────────┐
│ Destination ▼ | Category ▼ | Duration ▼ | Price ▼ | Search │
└──────────────────────────────────────────────────────────────┘
```

Mobile:

```text
[Search Tours...]

[Filter]
[Sort]
```

Filtering should update results without requiring full-page reload where practical.

Vue may be used for this enhancement.

---

# 36. Global Inquiry Modal

Reusable inquiry component:

```text
┌────────────────────────────────────────────┐
│ Send Inquiry                         ×     │
├────────────────────────────────────────────┤
│                                            │
│ Name                                       │
│ [________________________]                 │
│                                            │
│ Phone                                      │
│ [________________________]                 │
│                                            │
│ Email                                      │
│ [________________________]                 │
│                                            │
│ Travel Date                                │
│ [________________________]                 │
│                                            │
│ Message                                    │
│ [________________________]                 │
│                                            │
│           [SUBMIT INQUIRY]                 │
└────────────────────────────────────────────┘
```

The inquiry must automatically store context when launched from:

- Tour page
- Visa page
- Destination page
- Air ticket page
- Offer
- Blog CTA

Example:

```text
service_type = tour
reference_id = 123
```

---

# 37. Mobile Sticky Conversion Bar

Visible on mobile public pages.

```text
┌────────────────────────────────────────────┐
│   WhatsApp   |   Call   |   Inquiry        │
└────────────────────────────────────────────┘
```

Rules:

- Fixed bottom
- Does not cover important content
- Safe-area aware
- High contrast
- Accessible
- Small but usable
- Should not appear on admin pages

---

# 38. Loading States

Every dynamic component needs a loading state.

Example:

```text
┌─────────────────────────────┐
│ ░░░░░░░░░░░░░░░░░░░░░░░░   │
│ ░░░░░░░░░░░░░░░░░░░░░░░░   │
│ ░░░░░░░░░░░░░░░░░░░░░░░░   │
└─────────────────────────────┘
```

Use skeleton loading instead of unnecessary spinners.

---

# 39. Empty States

Example:

```text
┌──────────────────────────────────────────┐
│                                          │
│              No Tours Found              │
│                                          │
│ Try changing your filters or destination.│
│                                          │
│              [View All Tours]             │
│                                          │
└──────────────────────────────────────────┘
```

Other empty states:

- No visa results
- No blog results
- No gallery items
- No search results

---

# 40. Error States

Example:

```text
┌──────────────────────────────────────────┐
│                                          │
│       Something Went Wrong               │
│                                          │
│ We couldn't complete your request.       │
│ Please try again.                        │
│                                          │
│              [Try Again]                 │
└──────────────────────────────────────────┘
```

Never expose:

- Laravel stack traces
- SQL errors
- server paths
- API credentials
- internal exception details

---

# 41. Success States

Example:

```text
┌──────────────────────────────────────────┐
│                  ✓                       │
│                                          │
│          Request Submitted               │
│                                          │
│ Reference: INQ-2026-XXXX                 │
│                                          │
│ Our team will contact you shortly.       │
│                                          │
│ [Back to Home] [WhatsApp Us]             │
└──────────────────────────────────────────┘
```

---

# 42. Admin Dashboard Wireframe

Admin URL:

```text
/admin
```

Desktop:

```text
┌──────────────────────────────────────────────────────────────┐
│ LOGO                            Admin ▼   Notifications       │
├───────────────┬──────────────────────────────────────────────┤
│ SIDEBAR       │ DASHBOARD                                    │
│               │                                              │
│ Dashboard     │ ┌────────┐ ┌────────┐ ┌────────┐ ┌────────┐│
│ Tours         │ │ Tours  │ │ Visa   │ │ Ticket │ │Inquiry ││
│ Destinations  │ │   XX   │ │   XX   │ │   XX   │ │   XX   ││
│ Visa          │ └────────┘ └────────┘ └────────┘ └────────┘│
│ Applications  │                                              │
│ Tickets       │ ┌──────────────────────────────────────────┐ │
│ Inquiries     │ │ Inquiry / Application Activity            │ │
│ Offers        │ │                                          │ │
│ Testimonials  │ │ Chart / Table                             │ │
│ Gallery       │ └──────────────────────────────────────────┘ │
│ Blog          │                                              │
│ FAQ           │ ┌──────────────────┐ ┌─────────────────────┐│
│ Pages         │ │ Recent Inquiries │ │ Recent Applications ││
│ SEO           │ │                  │ │                     ││
│ Media         │ │ ...              │ │ ...                 ││
│ Users         │ └──────────────────┘ └─────────────────────┘│
│ Settings      │                                              │
└───────────────┴──────────────────────────────────────────────┘
```

---

# 43. Admin Navigation

```text
Dashboard

Content
├── Tours
├── Tour Categories
├── Destinations
├── Offers
├── Testimonials
├── Gallery
├── Blog
├── FAQ
└── Pages

Visa
├── Countries
├── Visa Types
├── Requirements
├── Profession Types
└── Applications

Requests
├── Tour Inquiries
├── Ticket Requests
├── Contact Messages
└── Custom Trip Requests

SEO
├── Metadata
├── Redirects
└── Sitemap

Media
└── Media Library

System
├── Users
├── Roles & Permissions
├── Settings
└── Activity Logs
```

---

# 44. Admin Tour Management

```text
┌──────────────────────────────────────────────────────────────┐
│ TOURS                                      [+ Add Tour]       │
├──────────────────────────────────────────────────────────────┤
│ Search...                    Category ▼   Status ▼           │
├──────────────────────────────────────────────────────────────┤
│                                                              │
│ Tour              Destination   Price    Status    Actions   │
│ ──────────────────────────────────────────────────────────── │
│ Thailand Escape  Thailand      ৳XX      Published  Edit ... │
│ Dubai Holiday    Dubai         ৳XX      Draft      Edit ... │
│ Maldives Escape  Maldives      ৳XX      Published  Edit ... │
│                                                              │
└──────────────────────────────────────────────────────────────┘
```

---

# 45. Admin Tour Editor

```text
┌──────────────────────────────────────────────────────────────┐
│ CREATE / EDIT TOUR                                            │
├──────────────────────────────────────────────────────────────┤
│ Basic Information                                             │
│                                                              │
│ Title              [________________________]                │
│ Slug               [________________________]                │
│ Destination        [Select ▼]                                │
│ Category           [Select ▼]                                │
│                                                              │
│ Pricing                                                        │
│ Starting Price     [____________]                            │
│ Sale Price         [____________]                            │
│                                                              │
│ Duration                                                        │
│ Days               [____]                                    │
│ Nights             [____]                                    │
│                                                              │
│ Featured Image     [Upload]                                  │
│                                                              │
│ Highlights                                                      │
│ [ + Add Highlight ]                                          │
│                                                              │
│ Itinerary                                                      │
│ [ + Add Day ]                                                │
│                                                              │
│ Includes                                                       │
│ [ + Add ]                                                    │
│                                                              │
│ Excludes                                                       │
│ [ + Add ]                                                    │
│                                                              │
│ SEO                                                           │
│ SEO Title          [________________________]                │
│ Meta Description   [________________________]                │
│                                                              │
│ Status [Draft ▼]                                             │
│                                                              │
│ [Save Draft]                         [Publish]                │
└──────────────────────────────────────────────────────────────┘
```

---

# 46. Admin Visa Application Management

```text
┌──────────────────────────────────────────────────────────────┐
│ VISA APPLICATIONS                                             │
├──────────────────────────────────────────────────────────────┤
│ Search | Country ▼ | Status ▼ | Date ▼                      │
├──────────────────────────────────────────────────────────────┤
│ Ref No      Applicant     Country     Status        Date      │
│                                                              │
│ VISA-001    Applicant A   Thailand    Under Review  16 Sep   │
│ VISA-002    Applicant B   UAE         Processing    16 Sep   │
│ VISA-003    Applicant C   Malaysia    Docs Required 15 Sep  │
└──────────────────────────────────────────────────────────────┘
```

Application detail:

```text
Applicant Information
Travel Information
Documents
Internal Notes
Status History
Communication History

[Change Status ▼]

Status:
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

# 47. Admin Ticket Request Management

```text
┌──────────────────────────────────────────────────────────────┐
│ AIR TICKET REQUESTS                                          │
├──────────────────────────────────────────────────────────────┤
│ Ref       Passenger     Route          Date       Status      │
│ TKT-001   John Doe      DAC → BKK      20 Sep     New         │
│ TKT-002   Jane Doe      DAC → DXB      25 Sep     Quoted      │
└──────────────────────────────────────────────────────────────┘
```

Detail:

```text
Passenger Information
Flight Requirements
Preferred Airline
Travel Dates
Passenger Count
Additional Requirements
Internal Notes
Fare / Quote
Status
```

---

# 48. Admin Inquiry Management

All lead sources should appear in a centralized inbox.

```text
┌──────────────────────────────────────────────────────────────┐
│ INQUIRIES                                                     │
├──────────────────────────────────────────────────────────────┤
│ All | New | Contacted | Follow-up | Converted | Closed       │
├──────────────────────────────────────────────────────────────┤
│ Name     Service      Reference     Status       Created      │
│                                                              │
│ Ahmed    Tour         TOUR-102      New          Today        │
│ Rahim    Visa         VISA-223      Contacted    Today        │
│ Karim    Ticket       TKT-102       Follow-up    Yesterday    │
└──────────────────────────────────────────────────────────────┘
```

---

# 49. Responsive Breakpoint Wireframe

## Mobile — `< 768px`

```text
1-column layout

Header
Hero
Search
Services
Tours
Destinations
Visa
Offers
Why Us
How It Works
Testimonials
Blog
FAQ
CTA
Footer
Sticky CTA
```

## Tablet — `768px–1023px`

```text
2-column cards
Condensed navigation
Reduced section spacing
Responsive filters
```

## Desktop — `1024px+`

```text
12-column grid
3–4 column card layouts
Sidebar filters
Expanded navigation
Large hero
```

## Large Desktop — `1280px+`

Content should remain within:

```text
max-width: 1280px
```

Avoid excessively stretched layouts.

---

# 50. Grid System

Desktop:

```text
12 Columns
│   │   │   │   │   │   │   │   │   │   │   │
```

Typical:

```text
Hero Content:
7 columns

Hero Search:
12 columns

Tour Cards:
4 + 4 + 4

Destination:
3 + 3 + 3 + 3

Blog:
4 + 4 + 4

Two-column content:
6 + 6
```

Tablet:

```text
8-column conceptual grid
```

Mobile:

```text
4-column conceptual grid
```

---

# 51. Component Inventory

Reusable UI components:

## Navigation

- TopBar
- Navbar
- MobileMenu
- Breadcrumbs

## Hero

- HeroSection
- HeroSearch
- SearchTabs

## Cards

- TourCard
- DestinationCard
- VisaCard
- OfferCard
- BlogCard
- TestimonialCard

## Forms

- InquiryForm
- TicketRequestForm
- CustomTripForm
- ContactForm
- VisaApplicationWizard

## Content

- SectionHeader
- FAQAccordion
- ItineraryTimeline
- RequirementList
- ProcessTimeline
- TrustFeatures

## Feedback

- Alert
- Toast
- SuccessState
- ErrorState
- EmptyState
- Skeleton

## Navigation

- Pagination
- Filters
- Sorting
- Tabs

## Conversion

- CTASection
- StickyMobileCTA
- WhatsAppButton
- CallButton
- InquiryModal

---

# 52. UX Interaction Rules

## Buttons

Primary:

```text
[Explore Tours]
[Apply for Visa]
[Request Fare]
[Start Inquiry]
```

Secondary:

```text
[Learn More]
[View Details]
[Read Guide]
```

All important conversion actions must have clear verbs.

Avoid generic:

```text
[Click Here]
[Submit]
[More]
```

where a more descriptive label is possible.

---

# 53. Form UX Rules

Every form should have:

- Visible labels
- Placeholder only as supplementary guidance
- Required indicators
- Inline validation
- Server-side validation
- Error messaging
- Success confirmation
- Loading state
- Accessible keyboard navigation
- Mobile-friendly controls

Example:

```text
Phone Number *
[____________________]

Please enter a valid Bangladeshi phone number.
```

---

# 54. Accessibility Wireframe Rules

Target:

> WCAG 2.2 AA-oriented implementation

Requirements:

- Keyboard navigation
- Visible focus states
- Semantic HTML
- Proper heading hierarchy
- Alt text
- Accessible form labels
- ARIA only where necessary
- Sufficient contrast
- Reduced motion support
- Touch targets approximately 44px+
- No information conveyed by color alone

---

# 55. SEO Wireframe Rules

Every indexable page should visually support:

```text
Breadcrumb
One H1
Logical H2/H3 sections
Main content
Internal links
Related content
CTA
```

Example:

```text
H1: Thailand Tour Packages from Bangladesh

H2: Thailand Tour Overview

H2: Popular Thailand Packages

H2: Best Time to Visit Thailand

H2: Thailand Visa Information

H2: Frequently Asked Questions
```

Search/filter pages should generally use:

```text
noindex, follow
```

when they generate thin or duplicate URLs.

---

# 56. Performance UX Rules

The wireframe must account for:

- Fast first render
- Server-rendered content
- Optimized images
- Lazy loading below-fold media
- Responsive images
- Minimal JavaScript
- Avoid unnecessary animation
- Avoid heavy video backgrounds
- Avoid layout shifts

Target Core Web Vitals:

```text
LCP < 2.5s
INP < 200ms
CLS < 0.1
```

These are performance targets, not guarantees.

---

# 57. Image Placement Rules

Preferred image ratios:

```text
Hero:
16:9 / cinematic

Tour:
4:3 or 16:10

Destination:
4:3

Blog:
16:9

Gallery:
Variable / masonry
```

Images should be:

- High quality
- Properly compressed
- WebP/AVIF where supported
- Responsive
- Lazy loaded below fold

Do not use huge original camera files directly.

---

# 58. Conversion Priority

Primary conversion:

```text
Tour Inquiry
Visa Application
Air Ticket Request
```

Secondary conversion:

```text
WhatsApp
Phone Call
Contact Form
Custom Trip Request
```

Discovery:

```text
Destinations
Blog
Gallery
FAQ
```

The page hierarchy should visually reflect this priority.

---

# 59. CTA Hierarchy

Golden accent should be reserved for important conversion actions.

Example:

```text
Primary:
[Start Your Inquiry]

Secondary:
[Explore Tours]

Tertiary:
[Learn More]
```

Avoid making every button golden.

---

# 60. Trust Architecture

Trust should appear throughout the user journey rather than in one isolated section.

Recommended locations:

```text
Hero
↓
Services
↓
Tour Detail
↓
Visa Detail
↓
Inquiry Form
↓
Testimonials
↓
Footer
```

Trust elements may include:

- Real company information
- Real office information
- Real contact channels
- Actual customer testimonials
- Genuine credentials/memberships
- Clear policies
- Transparent process
- Clear visa disclaimer
- Updated information timestamps

Never fabricate:

- Customer numbers
- Years of experience
- Success rates
- Awards
- Certifications
- Memberships
- Reviews

---

# 61. Global User Journey

## Tour Journey

```text
Homepage
   ↓
Tour Search
   ↓
Tour Listing
   ↓
Tour Detail
   ↓
Inquiry
   ↓
Consultation
   ↓
Booking
```

## Visa Journey

```text
Homepage
   ↓
Visa Services
   ↓
Country / Visa Detail
   ↓
Requirements
   ↓
Application
   ↓
Document Upload
   ↓
Review
   ↓
Submit
   ↓
Application Tracking
```

## Ticket Journey

```text
Homepage
   ↓
Air Ticketing
   ↓
Search Requirements
   ↓
Fare Request
   ↓
Agent Review
   ↓
Quote
   ↓
Customer Confirmation
   ↓
Booking
```

---

# 62. Internal Linking Wireframe

Each content page should connect to relevant pages.

Example:

```text
Thailand Tour
   │
   ├── Thailand Destination
   │
   ├── Thailand Visa
   │
   ├── Thailand Travel Guide
   │
   └── Related Thailand Tours
```

Visa page:

```text
Thailand Visa
   │
   ├── Thailand Destination
   │
   ├── Thailand Tours
   │
   ├── Visa Guide
   │
   └── Application
```

Blog:

```text
Article
   │
   ├── Related Destination
   ├── Related Tour
   ├── Related Visa
   └── Inquiry CTA
```

---

# 63. Breadcrumb Structure

Example:

```text
Home
└── Tours
    └── International
        └── Thailand Tour Package
```

Visa:

```text
Home
└── Visa Services
    └── Thailand
        └── Tourist Visa
```

Blog:

```text
Home
└── Travel Guide
    └── Thailand
        └── Thailand Visa Guide
```

---

# 64. URL Structure

Use clean human-readable URLs.

```text
/
 /about
 /tours
 /tours/{slug}
 /destinations
 /destinations/{slug}
 /visa
 /visa/{slug}
 /visa/apply
 /air-ticketing
 /custom-trip
 /gallery
 /blog
 /blog/{slug}
 /faq
 /contact
 /privacy-policy
 /terms-and-conditions
 /refund-cancellation-policy
 /visa-disclaimer
 /cookie-policy
```

Avoid:

```text
/tour?id=123
/page.php?id=10
/category/123
```

---

# 65. Admin UX Principles

Admin must optimize for operational efficiency.

Priorities:

```text
Fast content editing
Fast inquiry management
Fast visa application processing
Fast status updates
Easy media management
Easy SEO editing
Clear audit history
```

Avoid unnecessary dashboard complexity.

---

# 66. Admin Responsive Behavior

Desktop:

```text
Sidebar + Main Content
```

Tablet:

```text
Collapsed Sidebar + Main Content
```

Mobile:

```text
Top Header
↓
Drawer Navigation
↓
Single-column Content
```

Tables should become:

```text
Cards
```

on small screens when horizontal scrolling would create poor usability.

---

# 67. Admin Status Colors

Status must not rely only on color.

Example:

```text
● New
● Under Review
● Processing
● Documents Required
● Completed
● Rejected
● Cancelled
```

Use:

- Color
- Label
- Optional icon

simultaneously.

---

# 68. Notification UX

Admin notifications:

```text
┌────────────────────────────────────┐
│ 🔔 Notifications              View │
├────────────────────────────────────┤
│ New visa application               │
│ New ticket request                 │
│ New tour inquiry                   │
│ New contact message                │
└────────────────────────────────────┘
```

Possible notification channels:

- Admin dashboard
- Email
- WhatsApp/SMS if integrated later

---

# 69. Technical UX Boundary

Use Blade for:

- SEO content
- Static page rendering
- Tour pages
- Destination pages
- Visa content
- Blog content
- Legal pages

Use Vue where interaction benefits from client-side state:

- Search filters
- Inquiry modal
- Visa wizard
- Admin dashboard
- Admin forms
- Dynamic tables
- Interactive gallery
- Selective widgets

Do not turn the entire public website into a heavy SPA unnecessarily.

---

# 70. Final Wireframe Acceptance Criteria

The wireframe is considered complete when:

### Public Website

- [ ] Homepage structure implemented
- [ ] Header/navigation defined
- [ ] Mobile navigation defined
- [ ] Tour listing defined
- [ ] Tour detail defined
- [ ] Destination listing defined
- [ ] Destination detail defined
- [ ] Visa listing defined
- [ ] Visa detail defined
- [ ] Visa application wizard defined
- [ ] Air ticket page defined
- [ ] Custom trip page defined
- [ ] Contact page defined
- [ ] Gallery defined
- [ ] Blog listing defined
- [ ] Blog detail defined
- [ ] FAQ defined
- [ ] About page defined
- [ ] Legal pages defined
- [ ] Mobile sticky CTA defined

### UX

- [ ] Clear CTA hierarchy
- [ ] Search UX defined
- [ ] Filter UX defined
- [ ] Loading states defined
- [ ] Empty states defined
- [ ] Error states defined
- [ ] Success states defined
- [ ] Form validation states defined
- [ ] Accessibility considered
- [ ] Responsive behavior defined

### Admin

- [ ] Dashboard defined
- [ ] Navigation defined
- [ ] Tour management defined
- [ ] Visa management defined
- [ ] Visa application management defined
- [ ] Ticket request management defined
- [ ] Inquiry management defined
- [ ] Content management defined
- [ ] SEO management defined
- [ ] Media management defined
- [ ] User management defined
- [ ] Settings defined
- [ ] Audit logs defined

---

# 71. Master UX Principle

The entire website should answer three questions within seconds:

### 1. Where can I go?

> Destinations + Tours

### 2. Can you help me get there?

> Visa + Air Ticketing

### 3. How do I start?

> Inquiry + WhatsApp + Call

The final experience should feel:

> **Premium → Clear → Trustworthy → Fast → Helpful → Conversion-focused**

without becoming aggressive, cluttered, or template-like.