<?php
session_start();
require_once '../includes/config.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$student_id = $_SESSION['student_id'];
$student_name = $_SESSION['student_name'];

// جلب معلومات الطالب
$student_stmt = $conn->prepare("SELECT s.*, c.name AS college_name, m.name AS major_name
                                FROM students s
                                LEFT JOIN colleges c ON s.college_id = c.id
                                LEFT JOIN majors m ON s.major_id = m.id
                                WHERE s.id = ?");
$student_stmt->bind_param("i", $student_id);
$student_stmt->execute();
$student_info = $student_stmt->get_result()->fetch_assoc();

// جلب الكتب (محددة بـ 20 كتاب لزيادة الأداء)
$books_stmt = $conn->prepare("SELECT * FROM books WHERE student_id = ? ORDER BY created_at DESC LIMIT 20");
$books_stmt->bind_param("i", $student_id);
$books_stmt->execute();
$books = $books_stmt->get_result();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم الطالب</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(to bottom right, #f7f9fc, #e2e8f0);
        }
        .dashboard-box {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        .book-card h4,
        .book-card p {
            font-size: clamp(0.9rem, 1.5vw, 1.1rem);
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
    </style>
</head>
<body class="p-4">
    <div class="max-w-5xl mx-auto dashboard-box p-6">
        <!-- معلومات الطالب -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-chegg mb-2">👋 مرحبًا، <?= htmlspecialchars($student_name) ?></h2>
                <p class="text-sm text-gray-600">📘 الكلية: <?= htmlspecialchars($student_info['college_name'] ?? 'غير محددة') ?></p>
                <p class="text-sm text-gray-600">📚 التخصص: <?= htmlspecialchars($student_info['major_name'] ?? 'غير محدد') ?></p>
            </div>
            <a href="../auth/logout.php" class="text-red-600 font-semibold mt-4 md:mt-0 hover:underline">🔓 تسجيل الخروج</a>
        </div>

        <!-- الأزرار -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-8 text-center">
            <a href="add-book.php" class="bg-blue-600 text-white py-3 rounded-lg shadow hover:bg-blue-700 transition">
                ➕ إضافة كتاب
            </a>
            <a href="available-books.php" class="bg-green-600 text-white py-3 rounded-lg shadow hover:bg-green-700 transition">
                📚 عرض كل الكتب
            </a>
            <a href="my-requests.php" class="bg-orange-500 text-white py-3 rounded-lg shadow hover:bg-orange-600 transition">
                📥 طلباتي
            </a>
            <a href="../welcome.php" class="bg-gray-700 text-white py-3 rounded-lg shadow hover:bg-black transition">
                🏠 الصفحة الرئيسية
            </a>
        </div>

        <!-- الكتب -->
        <h3 class="text-xl font-semibold mb-4">📖 الكتب التي قمت بإضافتها:</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php while ($book = $books->fetch_assoc()): ?>
                <div class="book-card border border-gray-200 p-5 rounded-xl bg-white shadow-md hover:shadow-lg transition duration-300 overflow-hidden">
                    <h4 class="font-bold text-gray-800 mb-2"><?= htmlspecialchars($book['title']) ?></h4>
                    <p class="text-gray-600 mb-2 leading-relaxed"><?= htmlspecialchars(mb_strimwidth($book['description'], 0, 150, '...')) ?></p>
                    <p class="text-xs text-gray-500">📅 أضيف بتاريخ: <?= $book['created_at'] ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>