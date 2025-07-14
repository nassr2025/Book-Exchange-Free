<?php
session_start();
require_once '../includes/config.php';

// التحقق من تسجيل الدخول
if (!isset($_SESSION['student_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// التحقق من وجود book_id
if (!isset($_GET['book_id'])) {
    die("رقم الكتاب غير موجود.");
}

$book_id = intval($_GET['book_id']);

// التحقق من عدم وجود طلب سابق لنفس الكتاب من نفس الطالب
$check = $conn->prepare("SELECT * FROM book_requests WHERE book_id = ? AND student_id = ?");
$check->bind_param("ii", $book_id, $student_id);
$check->execute();
$existing = $check->get_result();

if ($existing->num_rows > 0) {
    echo "⚠️ لقد قمت بطلب هذا الكتاب مسبقًا.";
    exit();
}

// تنفيذ الطلب
$stmt = $conn->prepare("INSERT INTO book_requests (book_id, student_id, request_date) VALUES (?, ?, NOW())");
$stmt->bind_param("ii", $book_id, $student_id);

if ($stmt->execute()) {
    // إعادة التوجيه لصفحة الطلبات
    header("Location: my-requests.php?status=success");
    exit();
} else {
    echo "حدث خطأ أثناء إرسال الطلب.";
}
?>