<?php
session_start();
require_once 'includes/config.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: auth/login.php");
    exit();
}

if (!isset($_GET['book_id'])) {
    echo "المعذرة، لم يتم تحديد الكتاب.";
    exit();
}

$book_id = intval($_GET['book_id']);
$requester_id = $_SESSION['student_id'];

// تحقق هل تم طلب هذا الكتاب مسبقًا من نفس الطالب
$check = $conn->prepare("SELECT * FROM book_requests WHERE book_id = ? AND requester_id = ?");
$check->bind_param("ii", $book_id, $requester_id);
$check->execute();
$res = $check->get_result();

if ($res->num_rows > 0) {
    echo "<p style='color:red;'>لقد قمت بطلب هذا الكتاب مسبقًا!</p>";
    echo "<a href='welcome.php'>⬅ العودة للصفحة الرئيسية</a>";
    exit();
}

// إدخال الطلب الجديد
$stmt = $conn->prepare("INSERT INTO book_requests (book_id, requester_id) VALUES (?, ?)");
$stmt->bind_param("ii", $book_id, $requester_id);

if ($stmt->execute()) {
    echo "<p style='color:green;'>✅ تم إرسال طلبك بنجاح!</p>";
    echo "<a href='welcome.php'>⬅ العودة للصفحة الرئيسية</a>";
} else {
    echo "<p style='color:red;'>حدث خطأ أثناء إرسال الطلب!</p>";
}
?>