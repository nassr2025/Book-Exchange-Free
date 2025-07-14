<?php
session_start();
require_once '../includes/config.php';

// التحقق من تسجيل الدخول
if (!isset($_SESSION['student_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

// استعلام الكتب المتاحة
$stmt = $conn->prepare("SELECT b.*, s.name AS student_name 
                        FROM books b 
                        JOIN students s ON b.student_id = s.id 
                        ORDER BY b.created_at DESC");
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>الكتب المتاحة للتبادل</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: #f3f4f6;
        }
        .book-card {
            background: #fff;
            transition: box-shadow 0.3s ease;
        }
        .book-card:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }
        .btn-yellow {
            background-color: #f59e0b;
        }
        .btn-yellow:hover {
            background-color: #d97706;
        }
    </style>
</head>
<body class="p-6">
    <div class="max-w-6xl mx-auto bg-white rounded shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-chegg">📚 الكتب المتاحة حالياً</h2>
            <a href="dashboard.php" class="text-blue-600 hover:underline">🔙 الرجوع للوحة التحكم</a>
        </div>

        <!-- عرض الكتب بعمودين دائمًا -->
        <div class="grid grid-cols-2 gap-6">
            <?php while ($book = $result->fetch_assoc()): ?>
                <div class="book-card p-5 rounded-lg border border-gray-200">
                    <h3 class="text-xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($book['title'] ?? 'عنوان غير معروف') ?></h3>
                    <p class="text-gray-700 mb-1">📖 المؤلف: <?= htmlspecialchars($book['author'] ?? 'غير محدد') ?></p>
                    <p class="text-gray-700 mb-1">👨‍🎓 الطالب: <?= htmlspecialchars($book['student_name'] ?? 'غير معروف') ?></p>
                    <p class="text-sm text-gray-500 mb-4">📅 الإضافة: <?= $book['created_at'] ?></p>

                    <a href="request-book.php?book_id=<?= $book['id'] ?>" 
                       class="inline-block px-4 py-2 text-white rounded btn-yellow font-semibold transition">
                        📩 طلب الكتاب
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>