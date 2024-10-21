<?php
include 'database.php'; // подключаем базу данных

// Обработка удаления граммовки
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_measurement'])) {
    $measurement_id = $_POST['measurement_id'];
    // Удаляем граммовку из базы данных
    $stmt = $mysqli->prepare("DELETE FROM measurements WHERE id = ?");
    $stmt->bind_param("i", $measurement_id);
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
    <title>Удалить граммовку</title>
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
        <h1>Удалить граммовку</h1>

        <h3 class="mt-5">Список граммовок</h3>
        <form method="post">
            <div class="list-group">
                <?php foreach ($measurements as $measurement): ?>
                    <div class="list-group-item">
                        <span><?= htmlspecialchars($measurement['unit']) ?></span>
                        <button type="submit" name="delete_measurement" class="btn btn-danger btn-sm float-end" value="Удалить">Удалить</button>
                        <input type="hidden" name="measurement_id" value="<?= $measurement['id'] ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </form>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary">Назад</a>
        </div>
    </div>
</body>
</html>
