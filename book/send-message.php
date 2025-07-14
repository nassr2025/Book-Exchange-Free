<?php
require_once '../includes/config.php';
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$sender_id = $_SESSION['student_id'];
$receiver_id = $_GET['to'] ?? null;
$book_id = $_GET['book'] ?? null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, book_id, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $sender_id, $receiver_id, $book_id, $message);
    $stmt->execute();

    header("Location: ../student/dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إرسال رسالة</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">💬 إرسال رسالة إلى صاحب الكتاب</h2>
        <form method="post">
            <textarea name="message" required placeholder="اكتب رسالتك هنا..." class="w-full p-2 border mb-4" rows="5"></textarea>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">إرسال</button>
        </form>
    </div>
</body>
</html>
