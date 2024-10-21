<?php
include 'admin/database.php'; // подключаем базу данных

// Получаем id рецепта из параметров URL
if (isset($_GET['id'])) {
    $recipe_id = (int)$_GET['id'];

    // Получаем рецепт по id
    $stmt = $mysqli->prepare("SELECT title, description, instructions, image_path FROM recipes WHERE id = ?");
    $stmt->bind_param("i", $recipe_id);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($title, $description, $instructions, $image_path);
        $stmt->fetch();

        // Получаем ингредиенты для рецепта
        $stmt = $mysqli->prepare("SELECT i.name, ri.amount, m.unit FROM recipe_ingredients ri 
                                   JOIN ingredients i ON ri.ingredient_id = i.id 
                                   JOIN measurements m ON ri.measurement_id = m.id 
                                   WHERE ri.recipe_id = ?");
        $stmt->bind_param("i", $recipe_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $ingredients = [];
        while ($row = $result->fetch_assoc()) {
            $ingredients[] = $row;
        }
    } else {
        // Рецепт не найден
        echo "Рецепт не найден.";
        exit();
    }
} else {
    // Если id не передан
    echo "Некорректный запрос.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/cover.css" rel="stylesheet">
    <style>
    .recipe-image {
        max-width: 100%;
        height: auto;
        border-radius: 15px;
    }

    .content-wrapper {
        margin: 0 auto;
        max-width: 1200px;
        padding: 20px;
    }

    .btn {
        background-color: #f8f9fa;
        /* светло-серый фон */
        color: #343a40;
        /* темный текст */
        border: 1px solid #ced4da;
        /* светлая рамка */
        border-radius: 5px;
        /* закругленные углы */
        padding: 10px 20px;
        /* отступы внутри кнопки */
        transition: background-color 0.3s, box-shadow 0.3s;
        /* плавные переходы */
    }

    .btn:hover {
        background-color: #e2e6ea;
        /* чуть темнее при наведении */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* тень */
        color: #343a40;
    }

    .btn:active {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        /* уменьшенная тень при нажатии */
    }
    </style>
</head>

<body>
    <div class="d-flex h-100 text-center text-bg-dark">
        <div class="wrapper cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
            <?php include "header.php" ?>
        </div>
    </div>
    <div class="container mt-5 content-wrapper">
        <h1 class="text-center"><?= htmlspecialchars($title) ?></h1>
        <div class="row mt-4">
            <div class="col-md-7">
                <h5>Описание</h5>
                <p><?= htmlspecialchars($description) ?></p>

                <h5>Ингредиенты</h5>
                <ul class="list-group mb-3" id="ingredients-list">
                    <?php foreach ($ingredients as $ingredient): ?>
                    <li class="list-group-item ingredient-item" data-base-amount="<?= $ingredient['amount'] ?>">
                        <span class="ingredient-name"><?= htmlspecialchars($ingredient['name']) ?></span>
                        <span class="ingredient-amount"><?= htmlspecialchars($ingredient['amount']) ?></span>
                        <span class="ingredient-unit"><?= htmlspecialchars($ingredient['unit']) ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div class="btn-group mb-3" role="group">
                    <button type="button" class="btn btn-primary portion-button" data-multiplier="1">На 1
                        персону</button>
                    <button type="button" class="btn btn-primary portion-button" data-multiplier="2">На 2
                        персоны</button>
                    <button type="button" class="btn btn-primary portion-button" data-multiplier="4">На 4
                        персоны</button>
                    <button type="button" class="btn btn-primary portion-button" data-multiplier="6">На 6
                        персон</button>
                </div>

                <h5>Инструкции</h5>
                <p><?= nl2br(htmlspecialchars($instructions)) ?></p>



                <a href="recipe.php" class="btn btn-secondary mt-3">Назад</a>
            </div>
            <div class="col-md-5 text-center">
                <img src="<?= htmlspecialchars($image_path) ?>" class="img-fluid recipe-image"
                    alt="<?= htmlspecialchars($title) ?>">
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- изменяем через JS ко-во ингрдиентов -->
    <script>
    $(document).ready(function() {
        $('.portion-button').click(function() {
            const multiplier = $(this).data('multiplier');
            $('.ingredient-item').each(function() {
                const baseAmount = $(this).data('base-amount');
                const newAmount = baseAmount * multiplier;
                $(this).find('.ingredient-amount').text(newAmount);
            });
        });
    });
    </script>
</body>

</html>