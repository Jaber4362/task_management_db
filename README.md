<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
📋 نظام إدارة المهام المتطور
Task Management System
نظام متكامل لإدارة المهام والتصنيفات مبني باستخدام إطار العمل Laravel، مع دعم كامل للغة العربية وواجهة مستخدم سهلة وجميلة.

https://img.shields.io/badge/Laravel-11.x-red
https://img.shields.io/badge/PHP-8.2+-blue
https://img.shields.io/badge/MySQL-5.7+-orange
https://img.shields.io/badge/license-MIT-green

📝 وصف المشروع
Project Description
نظام إدارة المهام هو تطبيق ويب متكامل يساعد المستخدمين على تنظيم مهامهم اليومية وتصنيفها. تم بناء المشروع باستخدام Laravel 11 مع التركيز على تطبيق أفضل الممارسات في البرمجة وهندسة البرمجيات.

الميزات الرئيسية:

✅ نظام مصادقة كامل (تسجيل، دخول، تسجيل خروج)

✅ إدارة المهام (إنشاء، عرض، تعديل، حذف)

✅ إدارة التصنيفات (إنشاء، عرض، تعديل، حذف)

✅ ربط المهام بالتصنيفات

✅ تتبع حالة المهام (مكتملة / قيد التنفيذ)

✅ تحديد تاريخ استحقاق لكل مهمة مع تنبيه المهام المتأخرة

✅ لوحة تحكم تفاعلية مع إحصائيات شاملة

✅ واجهة مستخدم عربية بالكامل (RTL)

✅ تصميم متجاوب يعمل على جميع الأجهزة

✅ سياسات صلاحيات تمنع المستخدمين من الوصول لمهام غيرهم

✨ المميزات التقنية
Technical Features
🧩 MVC Architecture - تطبيق نمط Model-View-Controller

🔐 Authentication - نظام مصادقة متكامل باستخدام Laravel Breeze

🔑 Authorization - سياسات صلاحيات (Policies) للتحكم بالوصول

📊 Database Relationships - علاقات One-to-Many (مستخدم ← مهام، مستخدم ← تصنيفات)

✅ Validation - التحقق من صحة البيانات المدخلة

📱 Responsive Design - تصميم متجاوب مع Bootstrap 5

🌐 RTL Support - دعم كامل للغة العربية

⚡ AJAX - تحديث حالة المهام بدون إعادة تحميل الصفحة

📄 Pagination - تقسيم النتائج على صفحات

🔍 Eager Loading - تحسين أداء الاستعلامات

🛠️ التقنيات المستخدمة
Technologies Used
التقنية	الغرض
Laravel 11	إطار العمل الرئيسي
PHP 8.2+	لغة البرمجة
MySQL	قاعدة البيانات
Bootstrap 5	تصميم الواجهات
jQuery	تفاعلات JavaScript
Laravel Breeze	نظام المصادقة
Composer	إدارة الحزم
Git	التحكم بالنسخ
📁 هيكل المشروع
Project Structure
text
task-management-system/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # المتحكمات (TaskController, CategoryController, ProfileController)
│   │   └── Middleware/        # البرمجيات الوسيطة
│   ├── Models/                # النماذج (Task, Category, User)
│   ├── Policies/              # سياسات الصلاحيات (TaskPolicy)
│   └── Providers/             # مزودي الخدمة
├── database/
│   ├── migrations/            # ملفات الهجرة (إنشاء الجداول)
│   └── seeders/               # بيانات افتراضية (اختياري)
├── resources/
│   ├── views/                  # قوالب Blade
│   │   ├── layouts/            # التخطيط الرئيسي
│   │   ├── tasks/              # صفحات المهام
│   │   └── categories/         # صفحات التصنيفات
│   └── lang/                   # ملفات الترجمة (للغة العربية)
├── routes/
│   ├── web.php                 # مسارات الويب
│   └── auth.php                 # مسارات المصادقة
└── .env                         # إعدادات البيئة
🚀 كيفية التشغيل
Installation & Setup
المتطلبات الأساسية (Prerequisites)
PHP 8.2 أو أعلى

Composer

MySQL 5.7 أو أعلى

Node.js & NPM (اختياري)

خطوات التثبيت (Installation Steps)
1. استنساخ المستودع (Clone the repository)
bash
git clone https://github.com/username/task-management-system.git
cd task-management-system
2. تثبيت حزم Composer (Install Composer dependencies)
bash
composer install
3. إعداد ملف البيئة (Setup environment file)
bash
cp .env.example .env
4. إنشاء مفتاح التطبيق (Generate application key)
bash
php artisan key:generate
5. إعداد قاعدة البيانات (Configure database)
افتح ملف .env وعدّل إعدادات قاعدة البيانات:

text
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management_db
DB_USERNAME=root
DB_PASSWORD=
6. إنشاء قاعدة البيانات (Create database)
sql
CREATE DATABASE task_management_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
7. تشغيل الهجرات (Run migrations)
bash
php artisan migrate
8. تشغيل الخادم المحلي (Run development server)
bash
php artisan serve
9. الوصول للتطبيق (Access the application)
افتح المتصفح على الرابط: http://127.0.0.1:8000

🔑 بيانات الدخول الافتراضية
Default Login Credentials
بعد التشغيل، يمكنك تسجيل مستخدم جديد من صفحة التسجيل:

text
http://127.0.0.1:8000/register
أو استخدام بيانات المستخدم التجريبي (إذا تم إنشاؤه):

البريد الإلكتروني: test@example.com

كلمة المرور: password

📱 استخدام التطبيق
How to Use
المستخدم (User)
تسجيل حساب جديد - إنشاء حساب جديد للدخول للنظام

تسجيل الدخول - الدخول بحسابك الموجود

إدارة التصنيفات - إنشاء تصنيفات لتنظيم المهام (عمل، دراسة، شخصي، ...)

إدارة المهام - إضافة وتعديل وحذف المهام

تحديد الحالة - تحديد ما إذا كانت المهمة مكتملة أم لا

تحديد تاريخ الاستحقاق - تحديد تاريخ لإنجاز المهمة

لوحة التحكم - متابعة الإحصائيات والتقدم

المسارات الرئيسية (Main Routes)
الرابط	الوظيفة
/	الصفحة الرئيسية
/dashboard	لوحة التحكم
/tasks	قائمة المهام
/tasks/create	إضافة مهمة جديدة
/categories	قائمة التصنيفات
/profile	الملف الشخصي
🧪 اختبار المشروع
Testing
يمكنك اختبار المشروع باستخدام:

bash
php artisan test
أو اختبار العلاقات باستخدام tinker:

bash
php artisan tinker
🤝 المساهمة
Contributing
نرحب بمساهماتكم! للمساهمة:

Fork المشروع

أنشئ فرعاً جديداً (git checkout -b feature/amazing-feature)

Commit تغييراتك (git commit -m 'Add amazing feature')

Push للفرع (git push origin feature/amazing-feature)

افتح Pull Request

📄 الترخيص
License
هذا المشروع مرخص تحت MIT License.

📧 التواصل
Contact
البريد الإلكتروني: myown3216@gmail.com

GitHub:Jaber4362

LinkedIn: [your-profile](https://t.me/Mdk680)

🙏 الشكر والتقدير
Acknowledgments


📌 ملاحظة: هذا المشروع مبني لأغراض تعليمية لتطبيق مفاهيم Laravel بشكل عملي.

