# Quick-Cart

Quick-Cart is a PHP based e-commerce web application. It lets customers browse products, manage their carts, place orders, and track notifications. Admin users can manage categories, sub-categories, products, and customers from a dedicated back office.

## Main Features

- User registration and login with hashed passwords
- Product catalog with category filtering and carousel view
- Shopping cart with quantity updates and AJAX actions
- Checkout page with order summary
- Order history with item-level details
- Profile management, notifications, and password change
- Admin panel for categories, sub-categories, products, orders, and users

## Technology Stack

- PHP 8 (procedural + simple classes)
- MySQL / MariaDB
- Bootstrap 5 and custom CSS
- jQuery and AJAX utilities

## Prerequisites

- PHP 8.x and MySQL/MariaDB server (XAMPP or similar works well)
- Web server configured to serve this project directory

## Project Structure (Highlights)

```
Quick-Cart-main/
├── index.php                 # Public landing page
├── db.php                    # Database connection (shared)
├── include/                  # Shared header, footer, dashboards
├── admin/                    # Admin panel pages and assets
├── assets/                   # Front-end assets
├── js/, css/, images/        # Additional front-end resources
└── sql/                      # Database schema dump files
```

## Database Setup

1. Create a database named `new_project` (or adjust the name in `db.php`).
2. Import the schema dumps from the `sql/Table/` directory. Recommended order:
   - `new_project_table.sql`
   - `ec_categories.sql`
   - `ec_sub_categories.sql`
   - `ec_products.sql`
   - `my_cart.sql`
   - `ec_orders.sql`
   - `ec_order_items.sql`
   - `notification_table.sql`
   - `last_login_logout_table.sql`
   - `admin_users.sql`
3. The admin dump seeds a default admin user with username `admin` and password `admin123`.

## Environment Configuration

Open `db.php` and update these values if your database credentials differ:

```php
$host = "localhost";
$user = "root";
$password = "";
$db_name = "new_project";
```

## Install Dependencies

Currently there are no Composer dependencies required for this project.

## Running the Project

1. Place the project inside your server root (e.g., `htdocs/Quick-Cart-main`).
2. Start Apache and MySQL services.
3. Visit `http://localhost/Quick-Cart-main/` in your browser.
4. Register a new customer account or log in with an existing one.
5. Access the admin panel at `http://localhost/Quick-Cart-main/admin/login.php` using the seeded admin credentials.

### Test Accounts

- **Customer (for testing):**
  - Name: Hemraj Prajapati
  - Email: `hemraj@gmail.com`
  - Password: `12345`

- **Admin:**
  - Username: `admin`
  - Password: `admin@123`

## Usage Notes

- Customers can add items to the cart only after logging in.
- Cart actions (add, update, remove) send AJAX requests to `cart_controller.php`.
- Orders placed through checkout update the cart and populate order tables (ensure any custom order logic is implemented).
- Notifications are stored in `notification_table` and can be marked read/unread.

## Troubleshooting

- **Blank pages or errors:** enable PHP error reporting and check Apache logs.
- **Database errors:** confirm credentials in `db.php` and that all tables were imported.
- **Assets not loading:** ensure the project path matches the URLs in header/footer includes.
- **Mail sending:** email integration is not configured; add your preferred mail service if needed.

## Future Improvements (Ideas)

- Add payment gateway integration on checkout.
- Implement email/SMS notifications.
- Add inventory management and stock alerts.
- Create automated tests for cart and order flows.

---

Maintained with ❤️ by the Quick-Cart team.

