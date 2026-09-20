# Hostinger & cPanel Production Deployment Guide
## Emisha Tours & Travels Web Platform

This guide provides step-by-step instructions for deploying the **Emisha Tours & Travels** Laravel 11/12 + Vue 3 application to Hostinger Shared / Cloud / VPS Hosting or any standard cPanel environment.

---

## 1. Server Prerequisites

Ensure your Hostinger PHP configuration (under **hPanel > Advanced > PHP Configuration**) matches the following:
- **PHP Version:** `PHP 8.2` or `PHP 8.3`
- **Required PHP Extensions:**
  - `pdo_mysql`
  - `mbstring`
  - `openssl`
  - `tokenizer`
  - `xml`
  - `ctype`
  - `json`
  - `bcmath`
  - `fileinfo`
  - `curl`
  - `zip`
- **PHP Directives:**
  - `upload_max_filesize`: `20M`
  - `post_max_size`: `25M`
  - `memory_limit`: `256M`
  - `max_execution_time`: `120`

---

## 2. Directory Structure on Hostinger

### Recommended Hostinger Setup (Subdirectory Isolation)
1. Upload all project files to a private folder outside `public_html` (e.g. `/home/u123456789/emisha-app`).
2. Point your domain's Document Root in Hostinger to `/home/u123456789/emisha-app/public`.
3. If using shared hosting where Document Root is locked to `/public_html`:
   - Upload the entire project to `public_html`.
   - The included root `.htaccess` file automatically redirects web traffic safely into `public/`.

---

## 3. Environment & Database Configuration

1. Copy `.env.production.example` to `.env`:
   ```bash
   cp .env.production.example .env
   ```
2. Create a MySQL database and user in **hPanel > Databases > MySQL Databases**.
3. Update `.env` with your database credentials:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://emishatours.com

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=u123456789_emisha
   DB_USERNAME=u123456789_dbuser
   DB_PASSWORD=YourStrongPasswordHere

   # SMTP Mail Settings
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.hostinger.com
   MAIL_PORT=465
   MAIL_USERNAME=noreply@emishatours.com
   MAIL_PASSWORD=YourEmailPasswordHere
   MAIL_ENCRYPTION=ssl
   MAIL_FROM_ADDRESS="info@emishatours.com"
   MAIL_FROM_NAME="Emisha Tours & Travels"
   ```

4. Generate Application Encryption Key:
   ```bash
   php artisan key:generate
   ```

---

## 4. Database Migrations & Initial Seeding

Run database migrations and seed all realistic travel packages, visa checklists, and admin accounts:

```bash
php artisan migrate --force
php artisan db:seed --force
```

### Default Administrative Credentials:
- **Admin Portal URL:** `https://emishatours.com/admin/login`
- **Email:** `admin@emishatours.com`
- **Password:** `Admin@123456`
*(Please change this password immediately after first login via Global Settings or database).*

---

## 5. Storage Symlink & Private Disk Verification

1. Create the public storage symlink:
   ```bash
   php artisan storage:link
   ```

2. Ensure write permissions for file storage and caching:
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

3. **Confidential Document Security:**
   - Customer passports and bank statements uploaded through the Visa Application Wizard are automatically isolated inside `storage/app/private/visa/applications/`.
   - They are **never** accessible through public web URLs and are streamed exclusively to authenticated administrators through the controller.

---

## 6. Frontend Production Build

The production CSS and JS assets are pre-compiled in `public/build/`. If recompiling on a VPS or CI/CD runner:

```bash
npm install
npm run build
```

---

## 7. Production Performance & Caching

Run the following optimization commands in the terminal / SSH:

```bash
# Cache configuration files
php artisan config:cache

# Cache registered application routes
php artisan route:cache

# Pre-compile all Blade view templates
php artisan view:cache

# Optimize class loader
php artisan optimize
```

To clear caches during content updates:
```bash
php artisan optimize:clear
```

---

## 8. Automated Cron Job Configuration

Set up a Cron job in Hostinger (**hPanel > Advanced > Cron Jobs**) to run Laravel's scheduled tasks:

- **Interval:** Every Minute (`* * * * *`)
- **Command:**
  ```bash
  /usr/bin/php /home/u123456789/emisha-app/artisan schedule:run >> /dev/null 2>&1
  ```

---

## 9. Post-Deployment Verification Checklist

- [ ] Visit `https://emishatours.com` — verify SSL green lock and homepage rendering.
- [ ] Visit `https://emishatours.com/sitemap.xml` — verify valid XML output with tour/visa links.
- [ ] Visit `https://emishatours.com/robots.txt` — verify admin exclusion rules.
- [ ] Submit a test Holiday Package booking inquiry on any tour page.
- [ ] Submit a test Visa Application with test PDF documents.
- [ ] Log in to `https://emishatours.com/admin/login` and verify KPI cards, leads review, and secure PDF document downloads.
- [ ] Check email delivery for booking notifications.
