<?php
session_start();
require_once '../includes/config.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $college = $_POST['college'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $student_id = $_SESSION['student_id'];

    $image_name = $_FILES['image']['name'];
    $pdf_name = $_FILES['pdf']['name'];

    $image_path = '../assets/uploads/' . basename($image_name);
    $pdf_path = '../assets/uploads/' . basename($pdf_name);

    move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    move_uploaded_file($_FILES['pdf']['tmp_name'], $pdf_path);

    $stmt = $conn->prepare("INSERT INTO books (title, description, college, student_id, type, price, image, file_pdf) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisdss", $title, $description, $college, $student_id, $type, $price, $image_name, $pdf_name);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إضافة كتاب</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-xl mx-auto bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">➕ إضافة كتاب جديد</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="عنوان الكتاب" required class="w-full p-2 border mb-2" />
            <textarea name="description" placeholder="وصف الكتاب" required class="w-full p-2 border mb-2"></textarea>
            <input type="text" name="college" placeholder="الكلية" required class="w-full p-2 border mb-2" />
            <select name="type" required class="w-full p-2 border mb-2">
                <option value="Exchange">تبادل</option>
                <option value="Sale">بيع</option>
            </select>
            <input type="number" name="price" step="0.01" placeholder="السعر (0 إذا كان تبادل)" required class="w-full p-2 border mb-2" />
            <label class="block mb-1">صورة الكتاب:</label>
            <input type="file" name="image" accept="image/*" required class="w-full p-2 border mb-2" />
            <label class="block mb-1">ملف PDF (اختياري):</label>
            <input type="file" name="pdf" accept="application/pdf" class="w-full p-2 border mb-4" />
            <button type="submit" class="bg-green-600 text-white w-full p-2 rounded">نشر الكتاب</button>
        </form>
    </div>
</body>
</html>
