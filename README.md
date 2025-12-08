# License Manager

A SaaS-ready project that allows you to grant access to your private apps via licenses/keys. Each license can have an **expiry date** and a **device limit**.  
While designed primarily for Android apps, it can also be used on **iOS, macOS, or Windows**, as long as you can obtain a device identifier to enforce the device limit reliably.

---

## 🚀 Project Status
**Finished:** December 6th, 2025

---

## 🗝️ Default Credentials

- Username: `admin`
- Password: `admin111`

---

## 📄 License

Copyright © 2025 Karam (karamdev1)

All rights reserved.

This software and its source code are the property of Karam. 

You may use this software publicly and display it with your own name as the creator of the website or project built using this software. 
However, you may NOT copy, modify, distribute, or republish this software itself, or claim authorship of the original source code, without explicit written permission from the author.

---

## ⚙️ Requirements

- PHP 8.5+
- Composer

---

## 🛠️ Setup

1. Copy `.env.example` to `.env`  
2. Configure your database credentials in `.env`  
3. Run the following commands:

```bash
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan migrate:fresh --seed
