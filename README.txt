
# 📚 Book Exchange System for Students - Prince Sattam Bin Abdulaziz University

This project is a fully working web-based system to exchange or sell academic books among students of Prince Sattam University.

---

## ✅ Features

- Student Registration/Login System
- Add a book with image & PDF upload
- Browse all available books
- View detailed book information
- Send messages to book owners
- Admin dashboard to manage students
- Advanced search by college, title, and type
- Arabic language support & Tailwind CSS UI

---

## 🧰 Technologies Used

- **Frontend**: HTML, CSS, JavaScript, Tailwind CSS
- **Backend**: PHP (Core)
- **Database**: MySQL
- **Hosting**: Tested locally with KSWEB (Android-compatible)

---

## 🧪 How to Setup (Localhost or KSWEB)

### 1. Import Database
- Open **phpMyAdmin** or any MySQL interface.
- Create a new database named:
  ```
  book_exchange
  ```
- Import the provided SQL file: `book_exchange_data.sql`

---

### 2. Set Up Project Files
- Extract the ZIP archive into your local server directory:
  - For **KSWEB**, place it in: `/htdocs/`
  - For **XAMPP**, place it in: `htdocs/`
- Folder structure example:
  ```
  htdocs/
    └── book_exchange/
        ├── auth/
        ├── book/
        ├── public/
        ├── admin/
        ├── student/
        ├── search/
        ├── includes/
        └── assets/
  ```

---

### 3. Configure Database Connection

Edit the file:
```
includes/config.php
```

Make sure your settings are correct:
```php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'book_exchange';
$conn = new mysqli($host, $user, $pass, $db);
```

---

## 🧑‍💼 Default Access (Example)

- Admin access: **No password set** (session auto-starts)
- Pre-registered students: 30 students with sample books and messages

---

## 📦 Folder Summary

| Folder        | Description                          |
|---------------|--------------------------------------|
| `auth/`       | Login/Register logic for students    |
| `student/`    | Student dashboard + add book         |
| `book/`       | View book details, send messages     |
| `public/`     | View all books + inbox               |
| `search/`     | Advanced search interface            |
| `admin/`      | Admin dashboard + student editing    |
| `assets/`     | CSS, JS, image & file uploads        |
| `includes/`   | DB connection file                   |

---

## 👨‍🔧 Developer Notes

- Compatible with all browsers supporting Arabic fonts.
- You may add authentication for admin via `admin-login.php`.
- File upload accepts image files (`.jpg`, `.png`) and PDFs.

---

## 📧 Support

If you need help, contact the project developer or submit issues through the platform used for hosting.

---

