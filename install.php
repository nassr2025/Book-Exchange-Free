<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_exchange";

// الاتصال بالخادم
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("فشل الاتصال بالخادم: " . $conn->connect_error);
}

// إنشاء قاعدة البيانات إن لم تكن موجودة
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->select_db($dbname);

// حذف الجداول القديمة لتفادي التعارض
$conn->query("DROP TABLE IF EXISTS messages, books, students, majors, colleges, admins");

// تحميل ملف SQL الجديد
$sql_file_path = __DIR__ . "/book_exchange_data.sql";
if (!file_exists($sql_file_path)) {
    die("❌ لم يتم العثور على ملف قاعدة البيانات: book_exchange_data.sql");
}

$sql = file_get_contents($sql_file_path);

// تنفيذ الأوامر من الملف
if ($conn->multi_query($sql)) {
    echo "✅ تم تثبيت قاعدة البيانات والجداول والبيانات بنجاح.";
} else {
    echo "❌ خطأ أثناء تنفيذ الملف: " . $conn->error;
}

$conn->close();
?>
