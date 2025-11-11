# PT. Berdiri Matahari Logistik (BML) - Integrated Web Platform

[![Status](https://img.shields.io/badge/status-active-success.svg)]()
[![License](https://img.shields.io/badge/license-Proprietary-blue.svg)]()

## 📋 Deskripsi Singkat

Repository ini berisi sistem terintegrasi untuk PT. Berdiri Matahari Logistik, yang mencakup:

1. **Website Korporat** - Portal informasi perusahaan dengan layanan forwarding, warehouse, dan project operations
2. **E-Courier System** - Aplikasi manajemen pengiriman dan tracking kurir internal
3. **Leave Management System** - Sistem pengelolaan cuti dan izin karyawan dengan multi-level approval
4. **Attendance System** - Sistem pencatatan dan monitoring kehadiran karyawan
5. **Ticketing System** - Sistem manajemen tiket untuk IT support dan procurement (berbasis osTicket)

Project ini didesain untuk mendukung operasional internal PT. Berdiri Matahari Logistik dengan menyediakan tools digital untuk meningkatkan efisiensi manajemen logistik, HR, dan IT support.

---

## 🛠️ Teknologi & Framework

### Frontend
- **HTML5/CSS3** - Markup dan styling
- **Bootstrap 4.6** - CSS framework untuk responsive design
- **jQuery 3.6.0** - JavaScript library
- **AdminLTE 3.2** - Admin dashboard template (untuk Attendance)
- **Skydash** - Bootstrap admin template (untuk Leave Management)
- **Font Awesome 5.15.4** - Icon library
- **Chart.js 2.9.4** - Data visualization
- **DataTables 1.11.4** - Advanced table plugin
- **Select2 4.0.13** - Enhanced select box
- **SweetAlert2 11.4.0** - Beautiful alert/modal dialogs
- **Summernote 0.8.20** - WYSIWYG editor

### Backend
- **PHP** (Native, tanpa framework) - Server-side logic
- **MySQL/MariaDB** - Database management
- **osTicket** - Open source ticketing system

### Build Tools & Package Managers
- **npm** - Node package manager
- **Composer** - PHP dependency manager
- **Rollup** - JavaScript module bundler
- **Node-sass** - SASS compiler
- **Terser** - JavaScript minifier

### Third-Party Services
- **Google Maps API** - Location services
- **Google Analytics** - Web analytics

---

## 📁 Struktur Folder & Penjelasan

```
bml/
│
├── .git/                      # Git version control
├── .gitignore                 # Git ignore rules
│
└── public/                    # Root directory untuk semua aplikasi web
    │
    ├── index.html             # Landing page website korporat
    ├── AboutUs.html           # Halaman tentang perusahaan
    ├── Careers.html           # Halaman karir dan lowongan kerja
    ├── ContactUs.html         # Halaman kontak
    ├── ForwardingServices.html # Info layanan forwarding
    ├── WarehouseServices.html  # Info layanan warehouse
    ├── ProjectOpsServices.html # Info layanan project operations
    ├── GlobalNetwork.html      # Jaringan global BML
    ├── HSSE.html              # Health, Safety, Security & Environment
    ├── ISOCompliance.html      # Sertifikasi dan compliance ISO
    ├── Licenses.html          # Lisensi perusahaan
    ├── LocateUs.html          # Lokasi kantor
    ├── OrgStructure.html      # Struktur organisasi
    ├── OurHistory.html        # Sejarah perusahaan
    ├── MgmtPrinciples.html    # Prinsip manajemen
    ├── SafetyRules.html       # Peraturan keselamatan
    ├── Sitemap.html           # Peta situs
    ├── privacypolicy.html     # Kebijakan privasi
    ├── termsofuse.html        # Syarat dan ketentuan
    │
    ├── css/                   # Stylesheets untuk website korporat
    ├── js/                    # JavaScript files untuk website korporat
    ├── image/                 # Asset gambar website korporat
    ├── pdf/                   # Dokumen PDF
    │
    ├── courier/               # 📦 E-Courier System
    │   ├── index.php          # Login page courier
    │   ├── koneksi.php        # Database connection config
    │   ├── cek_login.php      # Authentication logic
    │   ├── admin/             # Admin panel courier
    │   │   ├── home.php       # Dashboard admin
    │   │   ├── manage_order.php    # Kelola order
    │   │   ├── master_kurir.php    # Master data kurir
    │   │   ├── master_alamat.php   # Master data alamat
    │   │   ├── todayorder.php      # Order hari ini
    │   │   ├── todaydelivery.php   # Delivery hari ini
    │   │   ├── pickup.php          # Pickup management
    │   │   ├── send.php            # Send management
    │   │   └── ...            # Module lainnya
    │   ├── kurir/             # Panel untuk kurir
    │   ├── user/              # Panel untuk user/requester
    │   ├── assets/            # Asset files (CSS, JS, images)
    │   └── img/               # Images
    │
    ├── leave/                 # 🏖️ Leave Management System
    │   ├── index.php          # Login page
    │   ├── cek_login.php      # Authentication
    │   ├── home.php           # Dashboard utama
    │   ├── add_cuti.php       # Form pengajuan cuti
    │   ├── app_master.php     # Approval master
    │   ├── app_level.php      # Multi-level approval
    │   ├── data_user.php      # Master user
    │   ├── documentation.php   # Dokumentasi sistem
    │   ├── assets/            # CSS, JS, images
    │   │   ├── configure/
    │   │   │   └── koneksi.php # Database connection
    │   │   └── ...
    │   ├── docs/              # Documentation files
    │   └── dist/              # Distribution files
    │
    ├── attendance/            # ⏰ Attendance System (AdminLTE based)
    │   ├── index.html         # Dashboard attendance
    │   ├── index2.html        # Alternative dashboard
    │   ├── index3.html        # Alternative dashboard
    │   ├── abnormal_report.php # Laporan kehadiran abnormal
    │   ├── package.json       # NPM dependencies
    │   ├── composer.json      # PHP dependencies
    │   ├── README.md          # AdminLTE documentation
    │   ├── build/             # Source files untuk build
    │   ├── dist/              # Compiled/minified files
    │   ├── pages/             # Application pages
    │   └── plugins/           # AdminLTE plugins
    │
    ├── procticket/            # 🎫 Procurement Ticketing (osTicket)
    │   ├── index.php          # Entry point
    │   ├── login.php          # User login
    │   ├── bootstrap.php      # Bootstrap file
    │   ├── open.php           # Create new ticket
    │   ├── tickets.php        # View tickets
    │   ├── account.php        # Account settings
    │   ├── include/           # Core osTicket includes
    │   │   ├── ost-config.php # Main configuration
    │   │   ├── class.*.php    # Class files
    │   │   ├── staff/         # Staff panel
    │   │   └── upgrader/      # Database upgrade scripts
    │   ├── assets/            # Static assets
    │   ├── css/               # Stylesheets
    │   ├── js/                # JavaScript
    │   └── api/               # API endpoints
    │
    └── ticketing/             # 🎫 IT Support Ticketing (osTicket)
        ├── (Similar structure to procticket)
        └── ...

Old_* files dan Old2_* files = Backup versi lama dari halaman website
```

---

## ⚙️ Instalasi & Konfigurasi

### Prerequisites

- **Web Server**: Apache 2.4+ atau Nginx
- **PHP**: 7.4+ (recommended 8.0+)
- **MySQL/MariaDB**: 5.7+ / 10.3+
- **Node.js**: 14+ (untuk build frontend assets)
- **Composer**: 2.0+ (untuk dependency management)
- **Git**: Untuk version control

### Instalasi Environment Development

#### 1. Clone Repository

```bash
git clone https://github.com/shev29/bml.git
cd bml
```

#### 2. Setup Web Server

**Apache (dengan Virtual Host):**

```apache
<VirtualHost *:80>
    ServerName bml.local
    DocumentRoot /path/to/bml/public
    
    <Directory /path/to/bml/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/bml_error.log
    CustomLog ${APACHE_LOG_DIR}/bml_access.log combined
</VirtualHost>
```

**Nginx:**

```nginx
server {
    listen 80;
    server_name bml.local;
    root /path/to/bml/public;
    index index.html index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

#### 3. Setup Database

Buat database untuk setiap aplikasi:

```sql
-- Database untuk E-Courier
CREATE DATABASE bml_courier CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Database untuk Leave Management
CREATE DATABASE bml_leave CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Database untuk Procurement Ticketing
CREATE DATABASE bml_procticket CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Database untuk IT Support Ticketing  
CREATE DATABASE bml_ticketing CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Buat user dan grant privileges
CREATE USER 'bml_user'@'localhost' IDENTIFIED BY 'secure_password';
GRANT ALL PRIVILEGES ON bml_courier.* TO 'bml_user'@'localhost';
GRANT ALL PRIVILEGES ON bml_leave.* TO 'bml_user'@'localhost';
GRANT ALL PRIVILEGES ON bml_procticket.* TO 'bml_user'@'localhost';
GRANT ALL PRIVILEGES ON bml_ticketing.* TO 'bml_user'@'localhost';
FLUSH PRIVILEGES;
```

#### 4. Konfigurasi Database Connection

**Untuk Courier System:**
Edit `public/courier/koneksi.php`

**Untuk Leave Management:**
Edit `public/leave/assets/configure/koneksi.php`

**Untuk Ticketing Systems:**
Edit `public/procticket/include/ost-config.php` dan `public/ticketing/include/ost-config.php`

#### 5. Install Dependencies (Attendance System)

```bash
cd public/attendance

# Install npm dependencies
npm install

# Install composer dependencies (if needed)
composer install

# Build assets (optional, untuk development)
npm run dev

# Build untuk production
npm run production
```

#### 6. Setup Permissions

```bash
# Set proper permissions untuk upload directories
chmod -R 755 public/
chmod -R 777 public/courier/doc_pendukung/
chmod -R 777 public/leave/doc_pendukung/
chmod -R 777 public/procticket/assets/
chmod -R 777 public/ticketing/assets/
```

---

## 🔐 Environment Variables

Setiap sub-aplikasi memiliki konfigurasi database sendiri. Berikut template konfigurasi:

### Courier System (`courier/koneksi.php`)

```php
<?php
$servername = "localhost";          // Database host
$userdb = "bml_user";               // Database username
$password = "your_secure_password";  // Database password
$dbname = "bml_courier";            // Database name

$conn = new mysqli($servername, $userdb, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
```

### Leave Management System (`leave/assets/configure/koneksi.php`)

```php
<?php
$servername = "localhost";
$userdb = "bml_user";
$password = "your_secure_password";
$dbname = "bml_leave";

$conn = new mysqli($servername, $userdb, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
```

### Ticketing Systems (`procticket/include/ost-config.php`)

```php
<?php
define('SECRET_SALT','your_random_secret_key_here');
define('ADMIN_EMAIL','admin@yourdomain.com');

define('DBTYPE','mysql');
define('DBHOST','localhost');
define('DBNAME','bml_procticket');
define('DBUSER','bml_user');
define('DBPASS','your_secure_password');
?>
```

### ⚠️ Security Notes

1. **Jangan commit file konfigurasi dengan kredensial asli ke repository**
2. Gunakan `.gitignore` untuk exclude file config
3. Ganti semua default password sebelum production deployment
4. Aktifkan HTTPS untuk production environment
5. Implementasikan firewall rules untuk database access

---

## 🚀 Cara Menjalankan Aplikasi

### Development Mode

#### 1. Start Web Server

**Apache:**
```bash
sudo systemctl start apache2
# atau
sudo service apache2 start
```

**Nginx:**
```bash
sudo systemctl start nginx
sudo systemctl start php8.0-fpm
```

**PHP Built-in Server (untuk quick testing):**
```bash
cd public
php -S localhost:8000
```

#### 2. Start MySQL/MariaDB

```bash
sudo systemctl start mysql
# atau
sudo service mysql start
```

#### 3. Access Applications

- **Website Korporat**: http://localhost/ atau http://bml.local/
- **E-Courier System**: http://localhost/courier/
- **Leave Management**: http://localhost/leave/
- **Attendance System**: http://localhost/attendance/
- **Procurement Ticketing**: http://localhost/procticket/
- **IT Support Ticketing**: http://localhost/ticketing/

### Build Frontend Assets (Attendance System)

```bash
cd public/attendance

# Development mode dengan live reload
npm run dev

# Build untuk production (minified)
npm run production

# Compile CSS saja
npm run css

# Compile JavaScript saja
npm run js

# Run linter
npm run lint

# Watch untuk auto-compile saat file berubah
npm run watch
```

### Database Migration & Seeding

**Note**: Project ini tidak menggunakan migration framework. Database schema harus diimpor manual dari SQL dump atau setup wizard.

Untuk osTicket (procticket & ticketing):
1. Akses installer: http://localhost/procticket/setup/
2. Follow installation wizard
3. Hapus folder `setup/` setelah instalasi selesai

---

## ✨ Fitur Utama & Endpoint

### 1. Website Korporat (Static)

**Fitur:**
- Company profile dan sejarah
- Informasi layanan (Forwarding, Warehouse, Project Operations)
- Global network dan lokasi kantor
- Sertifikasi dan compliance (ISO, HSSE)
- Career portal
- Contact form

**Main Pages:**
- `/` - Homepage
- `/AboutUs.html` - About company
- `/OurHistory.html` - Company history
- `/ForwardingServices.html` - Forwarding services
- `/WarehouseServices.html` - Warehouse services
- `/ProjectOpsServices.html` - Project operations
- `/Careers.html` - Career opportunities
- `/ContactUs.html` - Contact information

### 2. E-Courier System

**Fitur:**
- Order management (create, track, update status)
- Kurir assignment dan management
- Pickup & delivery scheduling
- Master data alamat
- Real-time tracking
- Multiple search & filtering
- Reporting (daily orders, deliveries)

**User Roles:**
- Admin: Full access, manage orders, kurir, dan alamat
- Kurir: View assigned deliveries, update status
- User/Requester: Create order, track shipment

**Key Endpoints (PHP):**
- `POST /courier/cek_login.php` - User authentication
- `GET/POST /courier/admin/manage_order.php` - Order management
- `GET/POST /courier/admin/master_kurir.php` - Kurir master data
- `GET/POST /courier/admin/master_alamat.php` - Address master data
- `GET /courier/admin/todayorder.php` - Today's orders
- `GET /courier/admin/todaydelivery.php` - Today's deliveries
- `POST /courier/admin/post_order.php` - Create new order
- `POST /courier/admin/pickup.php` - Pickup management
- `POST /courier/admin/send.php` - Send/delivery management

### 3. Leave Management System

**Fitur:**
- Pengajuan cuti dengan attachment
- Multi-level approval workflow (SPV → Manager → HR)
- Jatah cuti per karyawan
- Approval matrix per department
- Leave balance tracking
- Reporting dan export
- Email notification (untuk approval)
- Master data (user, department, section, location)

**User Roles:**
- Employee: Submit leave request
- Supervisor: First level approval
- Manager: Second level approval
- HR GA: Final approval dan admin
- Admin: System configuration

**Key Endpoints (PHP):**
- `POST /leave/cek_login.php` - Authentication
- `GET/POST /leave/add_cuti.php` - Submit leave request
- `GET /leave/app_master.php` - View pending approvals
- `POST /leave/approve_spv.php` - Supervisor approval
- `POST /leave/approve_mng.php` - Manager approval
- `POST /leave/approve_hrgas.php` - HR approval
- `GET /leave/data_user.php` - User management
- `GET /leave/documentation.php` - System documentation

### 4. Attendance System

**Fitur:**
- Dashboard attendance overview
- Abnormal report (late, absent, early leave)
- Multiple dashboard views
- Chart & visualization
- Export reports

**Key Pages:**
- `/attendance/index.html` - Main dashboard
- `/attendance/index2.html` - Alternative dashboard
- `/attendance/abnormal_report.php` - Abnormal attendance report

### 5. Ticketing Systems (Procurement & IT Support)

**Fitur:**
- Create ticket (with attachment)
- Assign ticket ke staff/team
- Internal notes dan komunikasi
- Status tracking (Open, Assigned, Closed)
- SLA management
- Knowledge base
- Email integration
- Custom forms
- Reporting & analytics

**User Roles:**
- User/Client: Submit ticket, view status
- Agent/Staff: Handle ticket, reply, close
- Admin: System configuration, user management

**API Endpoints (osTicket):**
- `POST /api/tickets.json` - Create ticket via API
- `GET /api/tickets/{id}.json` - Get ticket details
- Authentication: API Key based

**Web Endpoints:**
- `GET /procticket/` - Client portal
- `GET /procticket/open.php` - Create new ticket
- `GET /procticket/tickets.php` - View tickets
- `POST /procticket/login.php` - Staff login
- `GET /procticket/include/staff/` - Staff panel

---

## 🗄️ Struktur Database

### Courier System (bml_courier)

**Tabel Utama:**
- `tb_users` - Data user (admin, kurir, requester)
- `tb_order` - Order/shipment records
- `tb_kurir` - Master data kurir
- `tb_alamat` - Master data alamat pengiriman
- `tb_status` - Status tracking history

**Relasi:**
```
tb_order → tb_kurir (kurir_id)
tb_order → tb_alamat (alamat_id)
tb_order → tb_users (created_by)
```

### Leave Management (bml_leave)

**Tabel Utama:**
- `tb_users` - Employee data
- `tb_cuti` - Leave request records
- `tb_approval` - Approval workflow
- `tb_jatah_cuti` - Leave balance per employee
- `tb_department` - Department master
- `tb_section` - Section/division master
- `tb_location` - Office location master

**Relasi:**
```
tb_cuti → tb_users (user_id)
tb_cuti → tb_approval (request_id)
tb_users → tb_department (dept_id)
tb_users → tb_section (section_id)
```

### Ticketing Systems (osTicket Standard Schema)

**Tabel Utama:**
- `ost_ticket` - Ticket records
- `ost_ticket_thread` - Ticket messages/communication
- `ost_staff` - Staff/agent data
- `ost_department` - Department/team
- `ost_help_topic` - Ticket categories
- `ost_sla` - SLA plans
- `ost_attachment` - File attachments

**Note**: Full database schema untuk osTicket dapat dilihat di dokumentasi resmi osTicket.

---

## 📝 Panduan Kontribusi (Contribution Guide)

### Coding Standards

#### PHP
- Follow **PSR-12** coding standard
- Gunakan meaningful variable names (camelCase atau snake_case konsisten)
- Tambahkan comments untuk logic yang kompleks
- Escape user input untuk prevent SQL injection
- Gunakan prepared statements untuk database query
- Validate dan sanitize semua input

**Contoh:**
```php
<?php
// Good
$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM tb_users WHERE id = ?");
$stmt->bind_param("i", $userId);

// Bad - SQL Injection vulnerable
$userId = $_GET['id'];
$query = "SELECT * FROM tb_users WHERE id = $userId";
```

#### HTML/CSS
- Gunakan indentation 2 atau 4 spaces (konsisten)
- Semantic HTML5 elements
- Class naming: BEM methodology atau konsisten
- Responsive design untuk mobile compatibility

#### JavaScript
- Use `const` dan `let`, avoid `var`
- Follow ES6+ standards
- Add comments untuk complex functions
- Handle errors properly (try-catch)

### Git Workflow

#### Branching Strategy

```
main (production)
  │
  ├── develop (development)
  │     │
  │     ├── feature/courier-tracking
  │     ├── feature/leave-notification
  │     ├── bugfix/login-error
  │     └── hotfix/security-patch
```

#### Branch Naming Convention

- `feature/[nama-fitur]` - untuk fitur baru
- `bugfix/[nama-bug]` - untuk fix bug
- `hotfix/[nama-fix]` - untuk urgent fix di production
- `refactor/[nama-refactor]` - untuk code refactoring
- `docs/[nama-doc]` - untuk update dokumentasi

#### Commit Message Format

```
<type>(<scope>): <subject>

<body>

<footer>
```

**Types:**
- `feat`: New feature
- `fix`: Bug fix
- `docs`: Documentation only
- `style`: Code formatting (tidak mengubah logic)
- `refactor`: Code refactoring
- `test`: Adding tests
- `chore`: Build process, dependencies

**Contoh:**
```
feat(courier): add real-time tracking feature

- Implement WebSocket connection
- Add tracking map visualization
- Update database schema

Closes #123
```

### Pull Request Process

1. **Buat branch baru** dari `develop`
   ```bash
   git checkout develop
   git pull origin develop
   git checkout -b feature/my-new-feature
   ```

2. **Develop dan commit** changes
   ```bash
   git add .
   git commit -m "feat(scope): description"
   ```

3. **Push ke repository**
   ```bash
   git push origin feature/my-new-feature
   ```

4. **Create Pull Request** di GitHub
   - Title: descriptive title
   - Description: detail perubahan, reason, testing notes
   - Assign reviewers
   - Link related issues

5. **Code Review** process
   - Wait untuk approval dari maintainer
   - Address review comments
   - Update PR jika ada changes diminta

6. **Merge** setelah approval
   - Maintainer akan merge ke develop
   - Delete branch setelah merge

### Testing Guidelines

- Test manual setiap perubahan sebelum commit
- Test di multiple browsers (Chrome, Firefox, Safari, Edge)
- Test responsive design di mobile devices
- Test dengan different user roles
- Document testing steps di PR description

### Documentation

- Update README.md jika ada perubahan pada setup/configuration
- Add inline comments untuk complex logic
- Document new features di documentation section
- Update API endpoint list jika ada perubahan

---

## ⚠️ Analisis Kelemahan & Potensi Issue

### 1. Security Issues

#### 🔴 Critical

1. **Kredensial Database Hardcoded**
   - **Issue**: Password database tersimpan dalam plain text di file PHP
   - **Risk**: Credential exposure jika repository public atau server compromised
   - **Recommendation**: 
     - Pindahkan credentials ke environment variables
     - Gunakan `.env` file dengan proper `.gitignore`
     - Implementasi secret management tools (Vault, AWS Secrets Manager)

2. **SQL Injection Vulnerability**
   - **Issue**: Beberapa query menggunakan string concatenation tanpa prepared statements
   - **Risk**: Database compromise, data theft
   - **Recommendation**: 
     - Migrate semua query ke prepared statements
     - Implement ORM atau query builder
     - Add input validation layer

3. **Cross-Site Scripting (XSS)**
   - **Issue**: Output tidak di-escape properly
   - **Risk**: Session hijacking, malicious script execution
   - **Recommendation**: 
     - Escape semua user input dengan `htmlspecialchars()`
     - Implement Content Security Policy (CSP)
     - Use template engine dengan auto-escaping

4. **Weak Password Storage**
   - **Issue**: Tidak ada informasi apakah password di-hash dengan algorithm yang strong
   - **Risk**: Password compromise jika database leaked
   - **Recommendation**: 
     - Use `password_hash()` dengan PASSWORD_BCRYPT atau PASSWORD_ARGON2ID
     - Implement password strength requirements
     - Add password change policy

5. **Missing CSRF Protection**
   - **Issue**: Form submissions tidak dilindungi CSRF token
   - **Risk**: Unauthorized actions via cross-site requests
   - **Recommendation**: 
     - Implement CSRF token untuk semua forms
     - Validate token di server-side
     - Use SameSite cookie attribute

#### 🟡 Medium

6. **Session Management**
   - **Issue**: Session configuration tidak terlihat (timeout, secure flags)
   - **Recommendation**: 
     - Set proper session timeout
     - Use secure and httponly flags untuk session cookies
     - Implement session regeneration after login

7. **File Upload Security**
   - **Issue**: Upload directories (`doc_pendukung/`) dengan permission 777
   - **Risk**: Malicious file upload dan execution
   - **Recommendation**: 
     - Validate file types dan extensions
     - Store uploads di luar web root
     - Scan uploaded files untuk malware
     - Set proper permissions (755 atau 644)

### 2. Code Quality & Architecture

#### 🟠 High

1. **No Framework Architecture**
   - **Issue**: Pure PHP tanpa framework modern
   - **Impact**: Hard to maintain, no MVC pattern, code duplication
   - **Recommendation**: 
     - Consider migration ke Laravel, CodeIgniter, atau Symfony
     - Implement MVC pattern untuk better separation of concerns
     - Use dependency injection

2. **Duplicate Code (Old_* files)**
   - **Issue**: Banyak file backup (`Old_*.html`, `Old2_*.html`)
   - **Impact**: Confusing structure, wasted storage
   - **Recommendation**: 
     - Remove old files, rely on Git history
     - Implement proper versioning strategy
     - Clean up repository

3. **No Dependency Management**
   - **Issue**: Libraries di-include secara manual (kecuali attendance)
   - **Impact**: Sulit update dependencies, security patches tertunda
   - **Recommendation**: 
     - Use Composer untuk PHP dependencies
     - Use npm/yarn untuk JavaScript dependencies
     - Regular dependency updates

4. **Mixed Concerns**
   - **Issue**: Database logic, business logic, dan presentation mixed dalam satu file
   - **Impact**: Hard to test, maintain, dan reuse code
   - **Recommendation**: 
     - Separate into Models, Controllers, Views
     - Create reusable service classes
     - Implement repository pattern

#### 🟡 Medium

5. **No Error Handling**
   - **Issue**: `die()` statements untuk error handling
   - **Impact**: Poor user experience, information leakage
   - **Recommendation**: 
     - Implement proper exception handling
     - Log errors appropriately
     - Show user-friendly error messages
     - Hide technical details dari end users

6. **Inconsistent Naming Conventions**
   - **Issue**: Mixed naming styles (camelCase, snake_case, PascalCase)
   - **Impact**: Code readability dan consistency
   - **Recommendation**: 
     - Define dan enforce coding standards
     - Use linters (PHP_CodeSniffer, ESLint)
     - Refactor gradually to consistent style

### 3. Performance Issues

1. **No Caching Layer**
   - **Issue**: Setiap request hit database
   - **Impact**: Slow response time, high database load
   - **Recommendation**: 
     - Implement Redis atau Memcached
     - Cache static content dengan proper headers
     - Use query result caching

2. **N+1 Query Problem**
   - **Issue**: Multiple queries dalam loops
   - **Impact**: Poor database performance
   - **Recommendation**: 
     - Use JOIN queries untuk fetch related data
     - Implement eager loading
     - Optimize query dengan EXPLAIN

3. **Large Asset Files**
   - **Issue**: Unminified CSS/JS, large images
   - **Impact**: Slow page load time
   - **Recommendation**: 
     - Minify dan compress assets
     - Optimize images (WebP format, proper sizing)
     - Implement CDN
     - Use lazy loading untuk images

4. **No Database Indexing Strategy**
   - **Issue**: Unclear if proper indexes implemented
   - **Impact**: Slow query performance
   - **Recommendation**: 
     - Add indexes pada frequently queried columns
     - Use composite indexes untuk multi-column queries
     - Regular query performance analysis

### 4. DevOps & Infrastructure

1. **No CI/CD Pipeline**
   - **Issue**: Manual deployment process
   - **Impact**: Error-prone deployments, inconsistency
   - **Recommendation**: 
     - Implement GitHub Actions atau GitLab CI
     - Automated testing before deployment
     - Automated deployment ke staging/production

2. **No Automated Testing**
   - **Issue**: No unit tests, integration tests, or E2E tests
   - **Impact**: Regressions, bugs in production
   - **Recommendation**: 
     - Implement PHPUnit untuk unit tests
     - Add integration tests untuk critical workflows
     - Consider Selenium atau Cypress untuk E2E tests

3. **No Monitoring & Logging**
   - **Issue**: No application monitoring atau centralized logging
   - **Impact**: Hard to debug production issues
   - **Recommendation**: 
     - Implement logging framework (Monolog)
     - Use monitoring tools (New Relic, Datadog)
     - Setup error tracking (Sentry)
     - Implement health check endpoints

4. **No Backup Strategy**
   - **Issue**: Unclear backup strategy untuk database dan files
   - **Impact**: Data loss risk
   - **Recommendation**: 
     - Automated daily database backups
     - Backup uploaded files regularly
     - Test restore procedures
     - Off-site backup storage

### 5. Documentation & Maintenance

1. **Limited Code Documentation**
   - **Issue**: Minimal inline comments dan documentation
   - **Impact**: Hard untuk new developers onboarding
   - **Recommendation**: 
     - Add PHPDoc comments
     - Document business logic dan workflows
     - Create developer onboarding guide

2. **No API Documentation**
   - **Issue**: Ticketing API tidak terdokumentasi dengan baik
   - **Impact**: Hard to integrate dengan external systems
   - **Recommendation**: 
     - Document API dengan OpenAPI/Swagger
     - Provide code examples
     - Versioning strategy

3. **No Changelog**
   - **Issue**: Tidak ada tracking perubahan versi
   - **Impact**: Unclear what changed between releases
   - **Recommendation**: 
     - Maintain CHANGELOG.md
     - Follow Semantic Versioning
     - Document breaking changes

### Priority Matrix

| Priority | Category | Action Items |
|----------|----------|--------------|
| P0 (Immediate) | Security | Fix SQL Injection, Remove hardcoded credentials, Implement CSRF protection |
| P1 (High) | Security | XSS protection, Password hashing, File upload security |
| P1 (High) | Code Quality | Remove duplicate files, Implement error handling |
| P2 (Medium) | Performance | Add caching layer, Optimize queries |
| P2 (Medium) | DevOps | Setup CI/CD, Implement monitoring |
| P3 (Low) | Code Quality | Refactor ke framework, Improve documentation |

---

## 📄 Lisensi & Kontak Developer

### Lisensi

Project ini adalah **proprietary software** milik **PT. Berdiri Matahari Logistik**.

**Copyright © 2024 PT. Berdiri Matahari Logistik. All Rights Reserved.**

Unauthorized copying, modification, distribution, or use of this software, via any medium, is strictly prohibited without explicit written permission from PT. Berdiri Matahari Logistik.

### Kontak Developer

**PT. Berdiri Matahari Logistik**

📍 **Alamat:**
- Lokasi kantor dapat dilihat di halaman [LocateUs.html](public/LocateUs.html)

📧 **Email:**
- General Inquiry: info@logisteed.com
- Technical Support: support@logisteed.com
- IT Department: it@logisteed.com

🌐 **Website:**
- Corporate: https://www.bml-logistik.com (placeholder)
- LinkedIn: https://www.linkedin.com/company/pt-berdiri-matahari-logistik

📞 **Telepon:**
- Main Office: [Lihat halaman Contact Us]
- IT Support: [Internal extension]

### Project Maintainers

**Lead Developer:**
- Nugroho (nugroho@logisteed.com) - System Administrator & Lead Developer

**Contributors:**
- Development Team PT. Berdiri Matahari Logistik
- IT Department

### Reporting Issues

Untuk melaporkan bugs, security vulnerabilities, atau feature requests:

1. **Internal Team**: Create ticket di internal ticketing system
2. **External Contributors**: Contact melalui email it@logisteed.com
3. **Security Issues**: Report privately ke security@logisteed.com

### Support & Maintenance

**Business Hours:**
- Monday - Friday: 08:00 - 17:00 WIB
- Saturday: 08:00 - 12:00 WIB
- Sunday & Holidays: Closed (Emergency support available)

**SLA:**
- Critical Issues: Response dalam 2 jam
- High Priority: Response dalam 4 jam
- Medium Priority: Response dalam 1 hari kerja
- Low Priority: Response dalam 3 hari kerja

---

## 📚 Referensi & Resources

### Framework & Library Documentation
- [AdminLTE Documentation](https://adminlte.io/docs/3.2/)
- [Bootstrap 4.6 Documentation](https://getbootstrap.com/docs/4.6/)
- [osTicket Documentation](https://docs.osticket.com/)
- [jQuery Documentation](https://api.jquery.com/)
- [Chart.js Documentation](https://www.chartjs.org/docs/)

### Development Tools
- [PHP Official Documentation](https://www.php.net/docs.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [Git Documentation](https://git-scm.com/doc)

---

## 📜 Changelog

### Version 1.0.0 (Current)
- Initial release dengan 5 integrated systems
- Corporate website
- E-Courier system
- Leave Management system
- Attendance system
- Ticketing systems (Procurement & IT Support)

---

**Last Updated**: November 2024  
**Version**: 1.0.0  
**Maintained by**: PT. Berdiri Matahari Logistik IT Department
