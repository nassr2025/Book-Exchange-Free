<?php
require_once 'includes/config.php';

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة تبادل الكتب - جامعة الأمير سطام</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html, body {
            max-width: 100%;
            overflow-x: hidden;
        }
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(to bottom right, #f6f8fb, #e9eef5);
        }
        .bg-chegg {
            background-color: #f37b1d;
        }
        .text-chegg {
            color: #f37b1d;
        }
        .book-card p, .book-card h3 {
            font-size: clamp(0.75rem, 2vw, 1rem);
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        .book-card {
            min-height: 220px;
        }
        .bg-stripes-black {
            background-image: linear-gradient(
                45deg,
                #000 25%,
                transparent 25%,
                transparent 50%,
                #000 50%,
                #000 75%,
                transparent 75%,
                transparent
            );
            background-size: 40px 40px;
        }
    </style>
</head>
<body>

    <!-- ✅ غلاف نصي مخصص -->
    <div class="w-full bg-orange-600 text-white text-center py-8 md:py-10">
        <h1 class="text-4xl md:text-5xl font-extrabold">Book Exchange</h1>
    </div>

    <!-- فاصل أسود مخطط -->
    <div class="w-full h-2 overflow-hidden relative mb-[-10px]">
        <div class="absolute w-full h-full bg-stripes-black"></div>
    </div>

    <!-- قسم الترحيب -->
    <div class="bg-white max-w-4xl mx-auto mt-4 mb-10 p-6 rounded-xl shadow-lg text-center relative z-10">
        <img src="assets/imgs/university_logo.png" alt="شعار الجامعة" class="w-20 h-20 mx-auto mb-4">
        <h1 class="text-2xl md:text-3xl font-extrabold text-chegg mb-2">مرحباً بكم في منصة تبادل الكتب الطلابية</h1>
        <h2 class="text-base md:text-lg text-gray-700 mb-4">Welcome to Prince Sattam bin Abdulaziz University Student Book Exchange</h2>
        <div class="flex flex-wrap justify-center gap-4 mb-4">
            <a href="auth/login.php" class="px-5 py-2 bg-chegg text-white rounded-xl shadow hover:opacity-90 transition-all">تسجيل الدخول</a>
            <a href="auth/register.php" class="px-5 py-2 bg-white border-2 border-chegg text-chegg rounded-xl shadow hover:bg-orange-50 transition-all">إنشاء حساب جديد</a>
        </div>
        <a href="#books-section" class="underline text-chegg hover:text-orange-700 text-sm">تصفح الكتب الآن →</a>
    </div>

    <!-- ✅ الغلافين بشكل أفقي مرتب -->
    <div class="bg-[#fefefe] py-6 mb-12">
        <div class="max-w-5xl mx-auto px-4 flex flex-col sm:flex-row justify-center items-center gap-4">
            <div class="w-full sm:w-1/2 overflow-hidden rounded-2xl shadow-lg hover:scale-[1.03] transition">
                <img src="assets/imgs/physics.png" alt="Physics Book" class="w-full h-auto object-cover">
            </div>
            <div class="w-full sm:w-1/2 overflow-hidden rounded-2xl shadow-lg hover:scale-[1.03] transition">
                <img src="assets/imgs/math.png" alt="Math Book" class="w-full h-auto object-cover">
            </div>
        </div>
    </div>

    <!-- قسم عرض الكتب -->
    <div id="books-section" class="max-w-6xl mx-auto px-6 py-12 bg-white rounded-t-3xl shadow-inner">
        <h2 class="text-2xl md:text-3xl font-bold text-center text-chegg mb-10">📚 الكتب المضافة حالياً</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php while ($book = $result->fetch_assoc()): ?>
                <div class="book-card bg-gray-50 p-4 rounded-xl shadow hover:shadow-md transition text-right">
                    <h3 class="font-bold mb-1"><?= htmlspecialchars($book['title']) ?></h3>
                    <?php if (!empty($book['author'])): ?>
                        <p class="text-gray-700">📖 المؤلف: <?= htmlspecialchars($book['author']) ?></p>
                    <?php endif; ?>
                    <p class="text-gray-700">👨‍🎓 الطالب: <?= htmlspecialchars($book['student_name']) ?></p>
                    <p class="text-gray-500 text-xs mt-2">📅 أضيف بتاريخ: <?= $book['created_at'] ?></p>
                    <a href="request-book.php?book_id=<?= $book['id'] ?>" 
                       class="mt-3 inline-block px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 text-sm">
                       📩 طلب هذا الكتاب
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

</body>
</html>