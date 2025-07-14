<?php
require_once '../includes/config.php';
session_start();

$search = $_GET['q'] ?? '';
$college = $_GET['college'] ?? '';
$type = $_GET['type'] ?? '';

$sql = "SELECT b.*, s.name AS student_name 
        FROM books b 
        JOIN students s ON b.student_id = s.id 
        WHERE 1=1";

$params = [];
$types = "";

if (!empty($search)) {
    $sql .= " AND (b.title LIKE ? OR b.description LIKE ?)";
    $search_param = "%" . $search . "%";
    $params[] = $search_param;
    $params[] = $search_param;
    $types .= "ss";
}

if (!empty($college)) {
    $sql .= " AND b.college = ?";
    $params[] = $college;
    $types .= "s";
}

if (!empty($type)) {
    $sql .= " AND b.type = ?";
    $params[] = $type;
    $types .= "s";
}

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>🔎 البحث عن كتاب</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">🔍 البحث عن كتاب</h2>
    <form method="get" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="اسم الكتاب أو وصفه" class="p-2 border rounded w-full">
        <input type="text" name="college" value="<?= htmlspecialchars($college) ?>" placeholder="الكلية" class="p-2 border rounded w-full">
        <select name="type" class="p-2 border rounded w-full">
            <option value="">النوع</option>
            <option value="Exchange" <?= $type == 'Exchange' ? 'selected' : '' ?>>تبادل</option>
            <option value="Sale" <?= $type == 'Sale' ? 'selected' : '' ?>>بيع</option>
        </select>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">بحث</button>
    </form>

    <?php if ($result->num_rows > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <?php while ($book = $result->fetch_assoc()): ?>
                <div class="border rounded p-4 bg-gray-50 shadow-sm">
                    <img src="../assets/uploads/<?= htmlspecialchars($book['image']) ?>" alt="صورة الكتاب" class="w-full h-40 object-cover rounded mb-2">
                    <h4 class="font-bold text-lg"><?= htmlspecialchars($book['title']) ?></h4>
                    <p class="text-sm text-gray-600"><?= htmlspecialchars(mb_strimwidth($book['description'], 0, 80, "...")) ?></p>
                    <p class="text-xs text-gray-500 mt-1">بواسطة: <?= htmlspecialchars($book['student_name']) ?></p>
                    <a href="../book/book-details.php?id=<?= $book['id'] ?>" class="block mt-3 bg-blue-600 text-white text-center py-1 rounded">عرض التفاصيل</a>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-gray-600">لم يتم العثور على نتائج مطابقة.</p>
    <?php endif; ?>
</div>
</body>
</html>
