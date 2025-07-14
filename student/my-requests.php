<?php
session_start();
require_once '../includes/config.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// جلب الطلبات الخاصة بالطالب الحالي
$stmt = $conn->prepare("
    SELECT b.title, b.author, b.description, s.name AS owner_name, r.request_date
    FROM book_requests r
    JOIN books b ON r.book_id = b.id
    JOIN students s ON b.student_id = s.id
    WHERE r.student_id = ?
    ORDER BY r.request_date DESC
");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$requests = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>طلباتي</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-5xl mx-auto bg-white rounded shadow p-6">
        <h2 class="text-2xl font-bold mb-4">📚 طلبات الكتب الخاصة بك</h2>

        <?php if ($requests->num_rows > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <?php while ($row = $requests->fetch_assoc()): ?>
                    <div class="border p-4 rounded bg-gray-50 shadow">
                        <h3 class="font-bold text-lg"><?= htmlspecialchars($row['title']) ?></h3>
                        <p class="text-sm text-gray-700 mb-1">✍ المؤلف: <?= htmlspecialchars($row['author']) ?></p>
                        <p class="text-sm text-gray-700 mb-1">👤 صاحب الكتاب: <?= htmlspecialchars($row['owner_name']) ?></p>
                        <p class="text-sm text-gray-600 mb-1">📖 <?= htmlspecialchars($row['description']) ?></p>
                        <p class="text-xs text-gray-500 mt-2">📅 تاريخ الطلب: <?= $row['request_date'] ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-600">لم تقم بطلب أي كتب بعد.</p>
        <?php endif; ?>
    </div>
</body>
</html>