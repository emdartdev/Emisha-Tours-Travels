# Admin Dashboard Light & Dark Theme System

## 1. Theme System Overview

The Emisha Tours & Travels Admin Dashboard features a centralized, production-grade **Light and Dark Theme System**. The system ensures crisp readability, modern aesthetics, optimal contrast ratios, and a seamless toggle mechanism across all administrative screens.

### Supported Themes
- **☀️ Light Mode (`light`)**: Clean slate-white surfaces, high-contrast dark text, subtle borders, and professional elevation.
- **🌙 Dark Mode (`dark`)**: Layered obsidian/deep-navy surfaces (`#0A1220`, `#071324`), legible soft-gray typography, high-contrast borders, and vivid status accents.

---

## 2. Default Theme & Logic

### Default Theme
> **Default Theme: Light Mode (`light`)**

### Resolution Logic
1. **Startup Check**: Inspect client `localStorage.getItem('admin-theme')`.
2. **Saved Setting**: If the stored value is `'dark'`, dark mode is initialized.
3. **No Preference / Default**: If no theme key is present or set to `'light'`, the system strictly defaults to **Light Mode**.
4. **OS Preference Isolation**: Operating system (`prefers-color-scheme`) dark mode is deliberately ignored so that first-time admin visits consistently open in pristine Light Mode.

```text
Check localStorage ('admin-theme')
       │
       ├─► Value == 'dark'  ──► Apply Dark Theme
       │
       └─► Value == null / 'light' ──► Apply Light Theme (Default)
```

---

## 3. Persistence & Flash Prevention

- **Storage Engine**: `localStorage`
- **Key**: `'admin-theme'`
- **Values**: `'light' | 'dark'`
- **Anti-Flash Mechanism**: An inline `<script>` tag is placed inside the `<head>` of `resources/views/layouts/admin.blade.php` before stylesheet rendering and DOM construction. This eliminates the Flash of Unstyled Content / Flash of Incorrect Theme (FOUC) during page navigation and hard refreshes.

---

## 4. Theme State Architecture

The theme state is governed by a unified Alpine.js controller at the root admin layout (`resources/views/layouts/admin.blade.php`):

```javascript
x-data="{
    theme: localStorage.getItem('admin-theme') === 'dark' ? 'dark' : 'light',
    toggleTheme() {
        this.theme = this.theme === 'dark' ? 'light' : 'dark';
        localStorage.setItem('admin-theme', this.theme);
        if (this.theme === 'dark') {
            document.documentElement.classList.add('dark');
            document.documentElement.setAttribute('data-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            document.documentElement.setAttribute('data-theme', 'light');
        }
    }
}"
```

---

## 5. Design Tokens (CSS Variables)

Centralized variables defined in `resources/css/app.css`:

```css
:root, [data-theme="light"] {
    --admin-bg: #F8FAFC;
    --admin-card-bg: #FFFFFF;
    --admin-card-border: #E2E8F0;
    --admin-card-hover: #F1F5F9;
    --admin-text-main: #0F172A;
    --admin-text-muted: #64748B;
    --admin-text-subtle: #94A3B8;
    --admin-input-bg: #FFFFFF;
    --admin-input-border: #CBD5E1;
    --admin-header-bg: rgba(255, 255, 255, 0.95);
    --admin-header-border: #E2E8F0;
}

html.dark, [data-theme="dark"] {
    --admin-bg: #0A1220;
    --admin-card-bg: #0F1D32;
    --admin-card-border: rgba(255, 255, 255, 0.08);
    --admin-card-hover: #16263F;
    --admin-text-main: #F1F5F9;
    --admin-text-muted: #94A3B8;
    --admin-text-subtle: #64748B;
    --admin-input-bg: #081220;
    --admin-input-border: rgba(255, 255, 255, 0.12);
    --admin-header-bg: rgba(10, 18, 32, 0.92);
    --admin-header-border: rgba(255, 255, 255, 0.08);
}
```

---

## 6. Components & Views Updated

| Component / View | Description of Theme Enhancements |
| :--- | :--- |
| `resources/css/app.css` | Token definitions, `.admin-card`, `.admin-input`, `.admin-header-bar`, `.admin-main-wrapper`, `.admin-table-*`. |
| `resources/views/layouts/admin.blade.php` | Anti-flash head script, Alpine.js root controller, modern Header theme toggle switcher. |
| `resources/views/admin/dashboard.blade.php` | KPI metric cards, performance chart wrappers, live activity logs, recent visa transactions. |
| `resources/views/components/flash-messages.blade.php` | Glassmorphic floating alerts supporting both themes without blinding opacity. |
| `resources/views/admin/visa/applications.blade.php` | Filter bars, search inputs, customer table rows, status pills, and pagination. |
| `resources/views/admin/visa/show.blade.php` | Applicant profile dossier, document attachments, status update forms, and audit trail cards. |
| `resources/views/admin/visa/countries.blade.php` & `country_form.blade.php` | Visa requirements catalog, fees configuration tables, modal forms, and slug inputs. |
| `resources/views/admin/tours/index.blade.php` & `form.blade.php` | Tour package grid/tables, rich markdown textareas, pricing inputs, and status badges. |
| `resources/views/admin/destinations/index.blade.php` & `form.blade.php` | Featured destinations registry, image thumbnail cards, and upload input fields. |
| `resources/views/admin/inquiries/index.blade.php` | Custom holiday inquiries inbox, urgency indicators, and WhatsApp direct contact buttons. |
| `resources/views/admin/tickets/index.blade.php` | Flight quotation pipeline, airline route details, and customer budget badges. |
| `resources/views/admin/messages/index.blade.php` | Contact form inquiries, sender details, and message status toggle actions. |
| `resources/views/admin/blog/index.blade.php` & `form.blade.php` | Article manager, category selectors, cover preview containers, and publishing toggles. |
| `resources/views/admin/gallery/index.blade.php` | Visual gallery asset management, multi-file upload zones, and photo card overlays. |
| `resources/views/admin/settings/index.blade.php` | General system configuration, emergency hotline settings, and SEO meta controls. |

---

## 7. Testing & Verification

1. **Default Mode Test**: Verified that a clean session with cleared `localStorage` reliably defaults to Light Mode.
2. **Toggle & Transition**: Verified smooth, instantaneous theme switching via the header button without full page reloads.
3. **Persistence Test**: Verified that toggling to Dark Mode retains Dark Mode across page reloads and route navigations.
4. **Contrast & Legibility**: Checked all form inputs, table headers, table alternating rows, card headers, and dropdowns to confirm high contrast in both themes.
5. **Isolation Test**: Confirmed that customer-facing public pages and the admin login screen remain independent and unmodified.
6. **Automated Suite**: Executed `php artisan test` with 50/50 automated test assertions passing.

---

## 8. Known Limitations & Notes
- Public website routes intentionally do not share the admin theme state to maintain strict brand guidelines on public marketing landing pages.
- The admin sidebar maintains a luxury deep-navy backdrop (`#071527` / `#050D1A`) with metallic gold accents across both light and dark modes to preserve executive brand identity.
