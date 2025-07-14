<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name      = sanitize($_POST['name']);
    $email     = sanitize($_POST['email']);
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $college_id = intval($_POST['college_id']);
    $major_id   = intval($_POST['major_id']);

    $stmt = $conn->prepare("INSERT INTO students (name, email, password, college_id, major_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssii", $name, $email, $password, $college_id, $major_id);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        $error = "حدث خطأ أثناء التسجيل.";
    }
}
?><!DOCTYPE html><html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل حساب جديد</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(to bottom right, #f6f8fb, #e9eef5);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-3xl p-10 rounded-2xl shadow-xl">
        <h2 class="text-2xl md:text-3xl font-extrabold text-center text-chegg mb-6">تسجيل حساب جديد</h2>
        <?php if (!empty($error)) echo "<p class='text-red-500 text-center mb-4'>$error</p>"; ?>
        <form method="post" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <input type="text" name="name" placeholder="الاسم الكامل" required class="p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400" />
            <input type="email" name="email" placeholder="البريد الجامعي" required class="p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400" />
            <input type="password" name="password" placeholder="كلمة المرور" required class="p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400" /><select name="college_id" required class="p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
            <option value="">اختر الكلية</option>
            <option value="1">كلية الطب</option>
            <option value="2">كلية طب الأسنان</option>
            <option value="3">كلية الصيدلة</option>
            <option value="4">كلية العلوم الطبية التطبيقية</option>
            <option value="5">كلية الهندسة</option>
            <option value="6">كلية هندسة وعلوم الحاسب</option>
            <option value="7">كلية العلوم والدراسات الإنسانية</option>
            <option value="8">كلية إدارة الأعمال</option>
            <option value="9">كلية التربية</option>
            <option value="10">كلية الآداب</option>
            <option value="11">الكليات التطبيقية</option>
        </select>

        <select name="major_id" required class="p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
            <option value="">اختر التخصص</option>
            <option value="1">طب وجراحة</option>
            <option value="2">إصلاح الأسنان</option>
            <option value="3">دكتور صيدلي</option>
            <option value="4">التمريض</option>
            <option value="5">الهندسة المدنية</option>
            <option value="6">هندسة الحاسب</option>
            <option value="7">الرياضيات</option>
            <option value="8">إدارة الأعمال</option>
            <option value="9">تعليم مبكر</option>
            <option value="10">اللغة العربية</option>
            <option value="11">البرمجة</option>
        </select>

        <div class="md:col-span-2">
            <button type="submit" class="w-full bg-orange-500 text-white py-3 rounded-lg font-bold hover:bg-orange-600 transition">إنشاء الحساب</button>
        </div>
    </form>
</div>

</body>
</html>