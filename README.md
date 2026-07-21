<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

<h1 align="center">🚗 CarShop Website</h1>

<p align="center">
  ระบบจัดการร้านรถยนต์ พัฒนาด้วย Laravel Framework
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-v11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License">
</p>

---

## 📋 เกี่ยวกับโปรเจค

**CarShop Website** คือระบบจัดการร้านขายรถยนต์แบบครบวงจร พัฒนาขึ้นเพื่อใช้เป็นโปรเจคสุดท้าย (Final Project) โดยระบบรองรับทั้งหน้าเว็บสำหรับลูกค้า และหน้าจัดการข้อมูลสำหรับผู้ดูแลระบบ

### ✨ ฟีเจอร์หลัก

- 🔐 **ระบบล็อกอิน / ออกจากระบบ** — รองรับสิทธิ์ผู้ดูแลและผู้ใช้ทั่วไป
- 🚗 **จัดการข้อมูลรถยนต์** — เพิ่ม แก้ไข ลบ รถยนต์พร้อมรูปภาพ
- 🏷️ **จัดการยี่ห้อรถ (Brand)** — เพิ่ม แก้ไข ลบ ยี่ห้อรถ
- 📂 **จัดการประเภทรถ (Category)** — แบ่งประเภทรถยนต์
- 👥 **จัดการลูกค้า (Customer)** — บันทึกข้อมูลลูกค้าและ LINE ID
- 📊 **แดชบอร์ด** — สรุปภาพรวมข้อมูลในระบบ
- 🌐 **หน้าเว็บสำหรับลูกค้า** — แสดงรายการรถยนต์ตามยี่ห้อและประเภท

---

## 🛠️ เทคโนโลยีที่ใช้

| ส่วน | เทคโนโลยี |
|------|-----------|
| Backend Framework | Laravel 11 |
| ภาษา | PHP 8.2+ |
| ฐานข้อมูล | MySQL 8.0 |
| Frontend | Blade Template + Bootstrap 5 |
| Build Tool | Vite |
| Alert | SweetAlert2 |

---

## ⚙️ วิธีติดตั้งบนเครื่อง (Local)

### ความต้องการของระบบ

- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL

### ขั้นตอนการติดตั้ง

```bash
# 1. Clone โปรเจค
git clone https://github.com/faizbenbenyapol/CarShop_Website.git
cd CarShop_Website

# 2. ติดตั้ง PHP dependencies
composer install

# 3. ติดตั้ง Node dependencies
npm install

# 4. คัดลอกไฟล์ .env
cp .env.example .env

# 5. แก้ไข .env ให้ตรงกับ database ของคุณ
# DB_DATABASE=carshops
# DB_USERNAME=root
# DB_PASSWORD=

# 6. สร้าง Application Key
php artisan key:generate

# 7. รัน Migration
php artisan migrate

# 8. Build assets
npm run dev

# 9. รันเซิร์ฟเวอร์
php artisan serve
```

เปิดเบราว์เซอร์ไปที่ → `http://localhost:8000`

---

## 🚀 วิธี Deploy บน Linux Server

```bash
# 1. Clone โปรเจค
git clone https://github.com/faizbenbenyapol/CarShop_Website.git /var/www/carshop
cd /var/www/carshop

# 2. ติดตั้ง dependencies (production mode)
composer install --no-dev --optimize-autoloader

# 3. ตั้งค่า .env
cp .env.example .env
nano .env   # แก้ไข DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD, APP_URL

# 4. สร้าง App Key
php artisan key:generate

# 5. ตั้งสิทธิ์โฟลเดอร์
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# 6. รัน Migration
php artisan migrate

# 7. Build assets
npm install && npm run build

# 8. Cache สำหรับ production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 📁 โครงสร้างโฟลเดอร์สำคัญ

```
CarShop_Website/
├── app/
│   ├── Http/
│   │   ├── Controllers/       # Controllers ทั้งหมด
│   │   └── Middleware/        # AdminMiddleware
│   └── Models/                # Eloquent Models
├── database/
│   ├── migrations/            # ไฟล์ Migration
│   └── seeders/               # Seeder สำหรับข้อมูลทดสอบ
├── public/
│   └── uploads/               # รูปภาพรถที่อัพโหลด
├── resources/
│   └── views/
│       ├── admin/             # หน้า Backend (Admin)
│       └── frontend/          # หน้า Frontend (ลูกค้า)
└── routes/
    └── web.php                # Routes ทั้งหมด
```

---

## 👨‍💻 ผู้พัฒนา

พัฒนาโดยทีมนักศึกษา — **Final Project**

---

## 📄 License

โปรเจคนี้อยู่ภายใต้สัญญาอนุญาต [MIT License](https://opensource.org/licenses/MIT)
