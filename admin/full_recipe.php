<?php
include 'database.php'; // подключаем базу данных

// Получаем ID рецепта из URL
$recipe_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Получаем информацию о рецепте
$recipe_stmt = $mysqli->prepare("SELECT r.title, r.description, r.instructions, c.name AS country_name
                                  FROM recipes r
                                  LEFT JOIN countries c ON r.country_id = c.id
                                  WHERE r.id = ?");
$recipe_stmt->bind_param("i", $recipe_id);
$recipe_stmt->execute();
$recipe_result = $recipe_stmt->get_result();
$recipe = $recipe_result->fetch_assoc();

// Получаем ингредиенты для рецепта
$ingredients_stmt = $mysqli->prepare("SELECT i.name, ri.amount, m.unit
                                      FROM recipe_ingredients ri
                                      LEFT JOIN ingredients i ON ri.ingredient_id = i.id
                                      LEFT JOIN measurements m ON ri.measurement_id = m.id
                                      WHERE ri.recipe_id = ?");
$ingredients_stmt->bind_param("i", $recipe_id);
$ingredients_stmt->execute();
$ingredients_result = $ingredients_stmt->get_result();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($recipe['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1><?php echo htmlspecialchars($recipe['title']); ?></h1>
    <p><strong>Страна:</strong> <?php echo htmlspecialchars($recipe['country_name']); ?></p>
    <h3>Описание:</h3>
    <p><?php echo nl2br(htmlspecialchars($recipe['description'])); ?></p>
    <h3>Инструкции:</h3>
    <p><?php echo nl2br(htmlspecialchars($recipe['instructions'])); ?></p>
    <h3>Ингредиенты:</h3>
    <ul>
        <?php while ($ingredient = $ingredients_result->fetch_assoc()): ?>
            <li>
                <?php echo htmlspecialchars($ingredient['amount']) . ' ' . htmlspecialchars($ingredient['unit']) . ' ' . htmlspecialchars($ingredient['name']); ?>
            </li>
        <?php endwhile; ?>
    </ul>
    <a href="recipes.php" class="btn btn-primary">Назад к списку рецептов</a>
</div>
</body>
</html>
