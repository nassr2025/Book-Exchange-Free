<?php
require_once '../includes/config.php';
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$student_id = $_SESSION['student_id'];
$stmt = $conn->prepare("SELECT m.*, s.name AS sender_name, b.title AS book_title 
                        FROM messages m 
                        JOIN students s ON m.sender_id = s.id 
                        JOIN books b ON m.book_id = b.id 
                        WHERE m.receiver_id = ? 
                        ORDER BY m.created_at DESC");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>صندوق الرسائل</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">📥 صندوق الرسائل</h2>
        <?php if ($result->num_rows > 0): ?>
            <ul class="space-y-4">
                <?php while ($msg = $result->fetch_assoc()): ?>
                    <li class="border p-4 rounded bg-gray-50">
                        <p class="font-semibold">من: <?= htmlspecialchars($msg['sender_name']) ?> | حول الكتاب: <?= htmlspecialchars($msg['book_title']) ?></p>
                        <p class="text-sm text-gray-700 mt-1"><?= nl2br(htmlspecialchars($msg['message'])) ?></p>
                        <p class="text-xs text-gray-500 mt-2">📅 <?= $msg['created_at'] ?></p>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p class="text-gray-600">لا توجد رسائل بعد.</p>
        <?php endif; ?>
    </div>
</body>
</html>
