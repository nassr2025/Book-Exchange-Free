<?php
session_start();
require_once '../includes/config.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$error = '';

// معالجة تسجيل الدخول
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT * FROM students WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password']) || $password === $user['password']) {
                $_SESSION['student_id'] = $user['id'];
                $_SESSION['student_name'] = $user['name'];
                header("Location: ../student/dashboard.php");
                exit();
            } else {
                $error = "كلمة المرور غير صحيحة!";
            }
        } else {
            $error = "البريد الإلكتروني غير مسجل!";
        }
    } else {
        $error = "يرجى تعبئة جميع الحقول!";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(to bottom right, #f5f7fa, #e2e8f0);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md text-right">
        <h2 class="text-2xl font-extrabold text-center text-orange-600 mb-6">تسجيل الدخول</h2>
        <?php if ($error): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-center shadow">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form method="POST" class="space-y-4">
            <input type="email" name="email" placeholder="البريد الجامعي" required
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
            <input type="password" name="password" placeholder="كلمة المرور" required
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
            <button type="submit"
                class="w-full bg-orange-500 text-white py-3 rounded-lg hover:bg-orange-600 transition duration-200">
                دخول
            </button>
        </form>
    </div>
</body>
</html>