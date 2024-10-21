<?php
include 'database.php'; // подключаем базу данных

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Получаем данные из формы
    $title = $_POST['title'];
    $description = $_POST['description'];
    $instructions = $_POST['instructions'];
    $country_id = $_POST['country_id'];
    $ingredients = $_POST['ingredients'];
    $amounts = $_POST['amounts'];
    $units = $_POST['units'];

    // 1. Обработка изображения
    $image_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploads_dir = '../images/recipe'; // Директория для загрузки изображений

        $tmp_name = $_FILES['image']['tmp_name'];
        $name = basename($_FILES['image']['name']);
        $unique_name = uniqid('recipe_', true) . '_' . $original_name; 
        $image_path = "$uploads_dir/$unique_name";

        move_uploaded_file($tmp_name, $image_path);
    }

    // 2. Вставляем новый рецепт с изображением
    $stmt = $mysqli->prepare("INSERT INTO recipes (title, description, instructions, country_id, image_path) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $title, $description, $instructions, $country_id, $image_path);
    $stmt->execute();
    
    // Получаем ID вставленного рецепта
    $recipe_id = $mysqli->insert_id;

    // 3. Обрабатываем ингредиенты
    for ($i = 0; $i < count($ingredients); $i++) {
        $ingredient_name = $ingredients[$i];
        $amount = $amounts[$i];
        $measurement_id = $units[$i]; // Здесь предполагается, что значение `units` – это ID из таблицы measurements

        // Проверяем, существует ли ингредиент в базе данных
        $stmt = $mysqli->prepare("SELECT id FROM ingredients WHERE name = ?");
        $stmt->bind_param("s", $ingredient_name);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Ингредиент существует, получаем его ID
            $stmt->bind_result($ingredient_id);
            $stmt->fetch();
        } else {
            // Ингредиент не существует, добавляем его
            $stmt = $mysqli->prepare("INSERT INTO ingredients (name) VALUES (?)");
            $stmt->bind_param("s", $ingredient_name);
            $stmt->execute();
            $ingredient_id = $mysqli->insert_id; // Получаем ID нового ингредиента
        }

        // 4. Добавляем связь между рецептом и ингредиентом
        $stmt = $mysqli->prepare("INSERT INTO recipe_ingredients (recipe_id, ingredient_id, amount, measurement_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $recipe_id, $ingredient_id, $amount, $measurement_id);
        $stmt->execute();
    }

    // Перенаправляем пользователя на страницу с успешным добавлением
    header("Location: succes.php");
    exit();
}
?>
