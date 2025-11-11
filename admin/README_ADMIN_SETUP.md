# Admin Panel Setup Guide

## Database Setup

1. **Run the SQL file to create admin_users table:**
   ```sql
   -- Execute the SQL file: sql/admin_users_table.sql
   ```

2. **Default Admin Credentials:**
   - Username: `admin`
   - Password: `admin123`
   - Email: `admin@quickcart.com`

## Admin Panel Features

### 🔐 Authentication System
- **Login Page**: `admin/login.php`
- **Logout**: `admin/logout.php`
- **Session Management**: `admin/auth_check.php`
- **Password Change**: `admin/change_password.php`

### 🛡️ Security Features
- Password hashing with PHP's `password_hash()`
- Session-based authentication
- Session timeout (30 minutes)
- SQL injection protection
- CSRF protection ready

### 📊 Admin Dashboard
- **Main Dashboard**: `admin/index.php`
- **Category Management**: `admin/view-categories.php`
- **Sub-Category Management**: `admin/view-sub-categories.php`
- **Product Management**: `admin/add-products.php`
- **User Management**: `admin/user_list.php`

## File Structure

```
admin/
├── login.php                    # Admin login page
├── logout.php                   # Logout functionality
├── auth_check.php              # Authentication middleware
├── change_password.php         # Change password page
├── change_password_controller.php # Password change handler
├── index.php                   # Main dashboard
├── ../db.php                   # Database connection (shared)
├── AdminFunctions.php          # Admin functions class
├── include/
│   ├── header.php             # Admin header with auth check
│   └── footer.php             # Admin footer
└── README_ADMIN_SETUP.md      # This file
```

## Usage Instructions

### 1. First Time Setup
1. Run the SQL file to create admin table
2. Access `admin/login.php`
3. Login with default credentials
4. Change password immediately

### 2. Adding New Admins
```sql
INSERT INTO admin_users (admin_id, username, email, password, full_name, role, status) 
VALUES ('ADMIN002', 'newadmin', 'newadmin@example.com', '$2y$10$...', 'New Admin', 'admin', 1);
```

### 3. Security Best Practices
- Change default password immediately
- Use strong passwords
- Regular password updates
- Monitor login activities
- Keep admin panel secure

## Admin Roles
- **super_admin**: Full access to all features
- **admin**: Standard admin access
- **moderator**: Limited access (can be customized)

## Session Management
- Sessions expire after 30 minutes of inactivity
- Automatic logout on session expiry
- Secure session handling
- Cross-page authentication check

## Troubleshooting

### Common Issues:
1. **Login not working**: Check database connection and table structure
2. **Session issues**: Ensure session_start() is called
3. **Permission denied**: Check file permissions and database access

### Database Connection:
- Update `db.php` with correct database credentials
- Ensure database exists and is accessible
- Check MySQL service is running

## Security Notes
- Never share admin credentials
- Use HTTPS in production
- Regular security updates
- Monitor admin activities
- Backup admin data regularly
