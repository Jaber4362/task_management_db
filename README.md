# نظام إدارة المهام

![لارافل](https://img.shields.io/badge/Laravel-11-red)
![PHP](https://img.shields.io/badge/PHP-8.2-blue)

## 📋 وصف المشروع
نظام متكامل لإدارة المهام والتصنيفات مبني باستخدام Laravel.

## ✨ المميزات
- ✅ إضافة وتعديل وحذف المهام
- ✅ إضافة وتعديل وحذف التصنيفات
- ✅ ربط المهام بالتصنيفات
- ✅ لوحة تحكم بإحصائيات شاملة

## 🚀 طريقة التشغيل
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
