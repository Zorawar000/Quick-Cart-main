# 🛒 QuickCart – PHP eCommerce Project

QuickCart is a Core PHP based eCommerce web application with an Admin Panel for managing products, categories, banners, and site content.  
This project is built for learning, practice, and real-world CMS style development.

---

## 🚀 Features Implemented

### 🔐 Admin Panel
- Secure Admin Login (Password Hashing)
- Admin Profile & Password Change
- Session-based Authentication

---

### 📦 Product Management
- Add / View Products
- Category & Sub-Category Management
- Product Image Upload
- Product Status (Active / Inactive)

---

### 🏷️ Banner Type Management
- Add Banner Types
- Assign Banner Type to Pages:
  - Home Page
  - About Page
  - Contact Page
  - Product Page
- Banner Positions:
  - **1 → Top**
  - **2 → Middle**
  - **3 → Bottom**
- Banner Type Description (CKEditor)
- Status Management (Active / Inactive)

---

### 🖼️ Banner Management (NEW)
- Add Banners with Image Upload
- Relate Banner with Banner Type
- Auto-generated Banner Preview URL
- Banner List with:
  - Banner Name
  - Banner Type
  - Page Name
  - Position (Top / Middle / Bottom)
  - Status
  - Added Date
- Clickable Preview Link for Each Banner

---

### 🔗 Auto Banner Preview System
Each banner automatically generates a preview URL like:

banner-view.php?bid=XXXXX&img=imagename.jpg&d=YYYYMMDD

This allows:
- Secure banner preview
- Separate banner display page
- Easy testing without frontend integration

---

## 🗂️ Database Structure

### Tables Used
- `ec_categories`
- `ec_sub_categories`
- `ec_products`
- `ec_banner_types`
- `ec_banners`
- `admin_users`
- `contact_us`
- `ec_orders`
- `ec_order_items`
- `my_cart`
- `last_login_logout_table`
- `new_project_table`
- `notification_table`

---

## 🛠️ Tech Stack

- **Backend:** Core PHP (OOP)
- **Database:** MySQL
- **Frontend:** HTML, CSS, Bootstrap
- **JavaScript:** jQuery, AJAX
- **Editor:** VS Code (Visual Studio Code), XAMPP
- **Version Control:** Git & GitHub

---

## 📁 Project Structure

Quick-Cart-main/
│
├── admin/
│ ├── add-banner.php
│ ├── add-banner-type.php
│ ├── view-banner.php
│ ├── banner-view.php
│ ├── banner_controller.php
│ ├── banner_type_controller.php
│ └── AdminFunctions.php
│
├── uploads/
│ └── banners/ 
│
├── sql/
│ └── Table/
│
└── README.md


---


---

## 📌 Future Enhancements (Planned)
- Banner Status Toggle (AJAX)
- Banner Edit & Delete
- Page-wise Banner Display (Frontend)
- Banner Expiry Date
- Role-based Admin Permissions

---


## For User Testing 
Usename :- hemraj@gmail.com
password :- hemraj@123


## For User Testing 
Usename :- admin@quickcart.com
password :- admin@123

## 👨‍💻 Author

**Rizwan Zorawar**  
Core PHP Developer | Learning ASP.NET & Advanced Backend Concepts

---

## ⭐ GitHub

If you find this project useful, don’t forget to ⭐ star the repository!
