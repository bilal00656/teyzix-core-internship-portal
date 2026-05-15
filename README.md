# TEYZIX CORE Internship Portal

A futuristic full-stack internship portal built with **PHP + MySQL + Bootstrap 5**, branded with the official TEYZIX CORE logo and banner.

## Features
- Modern dark/neon-green futuristic UI (glassmorphism, glow, animated background)
- Fully responsive (mobile / tablet / desktop)
- Home, Internships, Apply, Contact pages
- CV upload + MySQL storage
- Contact form saved to DB
- Admin panel: dashboard, applications, messages, search, delete, view CV
- Session-based admin authentication

## Quick Start (XAMPP)

1. Copy the entire `teyzixcore` folder into `C:\xampp\htdocs\`.
2. Start **Apache** and **MySQL** in XAMPP control panel.
3. Open <http://localhost/phpmyadmin>
4. Click **Import** → choose `database/teyzixcore_portal.sql` → **Go**.
   (This creates the database `teyzixcore_portal` with sample data.)
5. Visit <http://localhost/teyzixcore/>

## Admin Access

- URL: <http://localhost/teyzixcore/admin/login.php>
- Username: `admin`
- Password: `admin123`

## Database Config

Edit `config/db.php` if your MySQL credentials differ:
```php
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'teyzixcore_portal';
```

## InfinityFree / Shared Hosting

1. Create a MySQL database in your hosting control panel.
2. Import `database/teyzixcore_portal.sql` via phpMyAdmin.
3. Update `config/db.php` with the provided host/user/password/database.
4. Upload the project folder to `htdocs/` via FTP.
5. Ensure `uploads/` is writable (chmod 775).

## File Structure
```
teyzixcore/
├── index.php
├── internships.php
├── apply.php
├── contact.php
├── admin/
│   ├── login.php
│   ├── dashboard.php
│   ├── applications.php
│   ├── messages.php
│   ├── logout.php
│   └── _layout.php
├── config/db.php
├── includes/{header,footer}.php
├── assets/{css,js,images}/
├── uploads/         (CV uploads stored here)
├── database/teyzixcore_portal.sql
└── README.md
```

## Security Notes
- All form inputs use prepared statements (no SQL injection).
- All output is HTML-escaped.
- CV uploads are extension-validated (pdf/doc/docx) and size-limited (5MB).
- Change the default admin password before going live (`UPDATE admin_users SET password='your_new_password' WHERE username='admin';`).

---
© TEYZIX CORE — Core of Innovation. Where technology meets vision.
