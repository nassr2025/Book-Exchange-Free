<?php
require_once '../includes/config.php';
session_start();

// تحقق من وجود جلسة مشرف
if (!isset($_SESSION['admin_logged_in'])) {
    $_SESSION['admin_logged_in'] = true; // للمثال فقط. اجعلها آمنة لاحقاً.
}

$students = $conn->query("SELECT * FROM students ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم المشرف</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto bg-white rounded shadow p-6">
        <h2 class="text-2xl font-bold mb-4">🎓 لوحة تحكم المشرف</h2>
        <h3 class="text-lg font-semibold mb-2">قائمة الطلاب</h3>
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">الاسم</th>
                    <th class="p-2 border">البريد</th>
                    <th class="p-2 border">الكلية</th>
                    <th class="p-2 border">التخصص</th>
                    <th class="p-2 border">إجراء</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($s = $students->fetch_assoc()): ?>
                <tr>
                    <td class="p-2 border"><?= $s['id'] ?></td>
                    <td class="p-2 border"><?= htmlspecialchars($s['name']) ?></td>
                    <td class="p-2 border"><?= htmlspecialchars($s['email']) ?></td>
                    <td class="p-2 border"><?= htmlspecialchars($s['college']) ?></td>
                    <td class="p-2 border"><?= htmlspecialchars($s['major']) ?></td>
                    <td class="p-2 border">
                        <a href="edit-student.php?id=<?= $s['id'] ?>" class="text-blue-600">تعديل</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
