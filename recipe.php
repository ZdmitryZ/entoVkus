<?php
include 'admin/database.php'; // подключаем базу данных

// Получаем все страны из базы данных
$countries = [];
$result = $mysqli->query("SELECT * FROM countries");
while ($row = $result->fetch_assoc()) {
    $countries[] = $row;
}

// Получаем выбранную страну из GET-запроса, если она есть
$selected_country_id = isset($_GET['country_id']) ? $_GET['country_id'] : null;

// Получаем все рецепты из базы данных вместе с названиями стран
$recipes = [];
$query = "
    SELECT r.id, r.title, r.description, r.image_path, c.name AS country_name 
    FROM recipes r 
    JOIN countries c ON r.country_id = c.id
";

// Добавляем условие для фильтрации по стране, если выбрана
if ($selected_country_id) {
    $query .= " WHERE r.country_id = " . intval($selected_country_id);
}

$result = $mysqli->query($query);
while ($row = $result->fetch_assoc()) {
    $recipes[] = $row;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Все рецепты</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/cover.css" rel="stylesheet">
    <style>
        /* Задаем фиксированную высоту для изображений карточек */
        .card-img-top {
            height: 200px; /* Задайте необходимую высоту */
            object-fit: cover; /* Обрезка изображения по размеру карточки */
        }
        .card {
            height: 100%; /* Сделаем карточки одинаковой высоты */
        }
    </style>
</head>
<body>
<div class="d-flex h-100 text-center text-bg-dark">
        <div class="wrapper cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <?php include "header.php" ?>
        </div>
    </div>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Все рецепты</h1>
        
        <!-- Форма для фильтрации по стране -->
        <form method="GET" class="mb-4">
            <div class="input-group">
                <select name="country_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Выберите страну</option>
                    <?php foreach ($countries as $country): ?>
                        <option value="<?= $country['id'] ?>" <?= ($selected_country_id == $country['id']) ? 'selected' : '' ?>>
                            <?= $country['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button class="btn btn-outline-secondary" type="submit">Сортировать</button>
            </div>
        </form>

        <div class="row">
            <?php foreach ($recipes as $recipe): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?= $recipe['image_path'] ?>" class="card-img-top" alt="<?= $recipe['title'] ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= $recipe['title'] ?></h5>
                            <p class="card-text"><?= mb_strimwidth($recipe['description'], 0, 100, '...') ?></p>
                            <p class="card-text"><small class="text-muted">Страна: <?= $recipe['country_name'] ?></small></p>
                            <div class="mt-auto">
                                <a href="fullRecipe.php?id=<?= $recipe['id'] ?>" class="btn btn-primary">Открыть рецепт</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
