<?php
include 'database.php'; // подключаем базу данных

// Проверяем, был ли отправлен ID
if (isset($_POST['id'])) {
    $recipe_id = (int)$_POST['id'];

    // Сначала удаляем все ингредиенты, связанные с рецептом
    $stmt = $mysqli->prepare("DELETE FROM recipe_ingredients WHERE recipe_id = ?");
    $stmt->bind_param("i", $recipe_id);
    $stmt->execute();

    // Теперь удаляем рецепт
    $stmt = $mysqli->prepare("DELETE FROM recipes WHERE id = ?");
    $stmt->bind_param("i", $recipe_id);

    if ($stmt->execute()) {
        // Рецепт успешно удалён
        header("Location: recipeList.php"); // Перенаправление на страницу со списком рецептов
        exit();
    } else {
        echo "Ошибка при удалении рецепта: " . $stmt->error;
    }
} else {
    echo "ID рецепта не передан.";
}
?>
