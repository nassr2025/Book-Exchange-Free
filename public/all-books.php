<?php
require_once '../includes/config.php';
session_start();

$stmt = $conn->query("SELECT b.*, s.name AS student_name FROM books b JOIN students s ON b.student_id = s.id ORDER BY b.created_at DESC");
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>جميع الكتب المتاحة</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">📚 جميع الكتب المتاحة</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <?php while ($book = $stmt->fetch_assoc()): ?>
                <div class="border rounded p-4 bg-gray-50 shadow-sm">
                    <img src="../assets/uploads/<?= htmlspecialchars($book['image']) ?>" alt="صورة الكتاب" class="w-full h-40 object-cover rounded mb-2">
                    <h4 class="font-bold text-lg"><?= htmlspecialchars($book['title']) ?></h4>
                    <p class="text-sm text-gray-600"><?= htmlspecialchars(mb_strimwidth($book['description'], 0, 80, "...")) ?></p>
                    <p class="text-xs text-gray-500 mt-1">بواسطة: <?= htmlspecialchars($book['student_name']) ?></p>
                    <a href="../book/book-details.php?id=<?= $book['id'] ?>" class="block mt-3 bg-blue-600 text-white text-center py-1 rounded">عرض التفاصيل</a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
