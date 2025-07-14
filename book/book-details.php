<?php
require_once '../includes/config.php';
session_start();

if (!isset($_GET['id'])) {
    echo "لم يتم تحديد معرف الكتاب.";
    exit();
}

$book_id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT b.*, s.name AS student_name, s.email, s.college AS student_college, s.major AS student_major
                        FROM books b
                        JOIN students s ON b.student_id = s.id
                        WHERE b.id = ?");
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "الكتاب غير موجود.";
    exit();
}

$book = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($book['title']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <div class="flex flex-col md:flex-row gap-6">
            <div class="w-full md:w-1/3">
                <img src="../assets/uploads/<?= htmlspecialchars($book['image']) ?>" alt="صورة الكتاب" class="rounded shadow w-full">
                <?php if (!empty($book['file_pdf'])): ?>
                    <a href="../assets/uploads/<?= htmlspecialchars($book['file_pdf']) ?>" target="_blank" class="block mt-2 text-blue-600 hover:underline">
                        📄 تحميل الملف PDF
                    </a>
                <?php endif; ?>
            </div>

            <div class="w-full md:w-2/3">
                <h2 class="text-2xl font-bold mb-2"><?= htmlspecialchars($book['title']) ?></h2>
                <p class="mb-2 text-gray-600"><?= htmlspecialchars($book['description']) ?></p>

                <ul class="text-sm text-gray-700 space-y-1 mb-4">
                    <li>📚 الكلية: <?= htmlspecialchars($book['college']) ?></li>
                    <li>📌 النوع: <?= htmlspecialchars($book['type']) ?></li>
                    <li>💰 السعر: <?= $book['type'] === 'Sale' ? number_format($book['price'], 2) . " ريال" : "للـتبادل" ?></li>
                    <li>📅 تم الإضافة في: <?= $book['created_at'] ?></li>
                </ul>

                <div class="mt-4 bg-gray-50 p-4 rounded">
                    <h4 class="font-semibold mb-2">👤 معلومات صاحب الكتاب:</h4>
                    <p>الاسم: <?= htmlspecialchars($book['student_name']) ?></p>
                    <p>الكلية: <?= htmlspecialchars($book['student_college']) ?></p>
                    <p>التخصص: <?= htmlspecialchars($book['student_major']) ?></p>
                    <p>📧 التواصل: <?= htmlspecialchars($book['email']) ?></p>
                    <a href="send-message.php?to=<?= $book['student_id'] ?>&book=<?= $book['id'] ?>" class="block mt-3 bg-green-600 text-white px-4 py-2 rounded text-center hover:bg-green-700">
                        💬 إرسال رسالة إلى صاحب الكتاب
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
