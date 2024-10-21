<?php
include 'database.php'; // подключаем базу данных

// Обработка формы добавления граммовки
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['new_measurement'])) {
    $new_measurement = $_POST['new_measurement'];
    // Вставляем новую граммовку в базу данных
    $stmt = $mysqli->prepare("INSERT INTO measurements (unit) VALUES (?)");
    $stmt->bind_param("s", $new_measurement);
    $stmt->execute();
}

// Получаем список граммовок из базы данных
$measurements = [];
$result = $mysqli->query("SELECT id, unit FROM measurements");
while ($row = $result->fetch_assoc()) {
    $measurements[] = $row;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить граммовку</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/cover.css" rel="stylesheet">
</head>
<body>
<div class="d-flex h-100 text-center text-bg-dark">
        <div class="wrapper cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
            <?php include "../header.php"; ?>
        </div>
    </div>
    <div class="container mt-5">
        <h1>Добавить граммовку</h1>
        <form method="post">
            <div class="mb-3">
                <input type="text" name="new_measurement" class="form-control" placeholder="Название граммовки" required>
            </div>
            <button type="submit" class="btn btn-primary">Добавить граммовку</button>
        </form>

        <h3 class="mt-5">Список граммовок</h3>
        <ul class="list-group">
            <?php foreach ($measurements as $measurement): ?>
                <li class="list-group-item"><?= htmlspecialchars($measurement['unit']) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
