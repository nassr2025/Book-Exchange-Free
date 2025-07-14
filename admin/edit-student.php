<?php
require_once '../includes/config.php';
session_start();

if (!isset($_GET['id'])) {
    echo "رقم الطالب غير موجود.";
    exit();
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $college = $_POST['college'];
    $major   = $_POST['major'];
    $phone   = $_POST['phone'];

    $update = $conn->prepare("UPDATE students SET name = ?, email = ?, college = ?, major = ?, phone = ? WHERE id = ?");
    $update->bind_param("sssssi", $name, $email, $college, $major, $phone, $id);
    $update->execute();

    header("Location: admin-dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تعديل بيانات الطالب</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-xl mx-auto bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">✏️ تعديل بيانات الطالب</h2>
        <form method="post">
            <input type="text" name="name" value="<?= htmlspecialchars($student['name']) ?>" required class="w-full p-2 border mb-2" />
            <input type="email" name="email" value="<?= htmlspecialchars($student['email']) ?>" required class="w-full p-2 border mb-2" />
            <input type="text" name="college" value="<?= htmlspecialchars($student['college']) ?>" required class="w-full p-2 border mb-2" />
            <input type="text" name="major" value="<?= htmlspecialchars($student['major']) ?>" required class="w-full p-2 border mb-2" />
            <input type="text" name="phone" value="<?= htmlspecialchars($student['phone']) ?>" class="w-full p-2 border mb-4" />
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">حفظ التعديلات</button>
        </form>
    </div>
</body>
</html>
