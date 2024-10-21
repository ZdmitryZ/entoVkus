<?php
include 'database.php'; // подключаем базу данных

// Обработка формы добавления страны
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['new_country'])) {
    $new_country = $_POST['new_country'];
    // Вставляем новую страну в базу данных
    $stmt = $mysqli->prepare("INSERT INTO countries (name) VALUES (?)");
    $stmt->bind_param("s", $new_country);
    $stmt->execute();
}

// Получаем список стран из базы данных
$countries = [];
$result = $mysqli->query("SELECT id, name FROM countries");
while ($row = $result->fetch_assoc()) {
    $countries[] = $row;
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить рецепт</title>
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
        <h1>Добавить рецепт</h1>
        <form id="recipeForm" method="post" action="saveRecipe.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Название рецепта</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="instructions" class="form-label">Инструкции по приготовлению</label>
                <textarea class="form-control" id="instructions" name="instructions" rows="5"></textarea>
            </div>

            <div class="form-group">
                <label for="country">Страна:</label>
                <select class="form-control" id="country" name="country_id" required>
                    <?php foreach ($countries as $country): ?>
                    <option value="<?= $country['id'] ?>"><?= $country['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Загрузить изображение</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>

            <h3>Ингредиенты</h3>
            <div id="ingredients-list">
                <div class="ingredient-row">
                    <div class="row m-3">
                        <div class="col-md-4">
                            <input type="text" name="ingredients[]" class="form-control" placeholder="Ингредиент"
                                required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="amounts[]" class="form-control" placeholder="Количество"
                                required>
                        </div>
                        <div class="col-md-3">
                            <select name="units[]" class="form-control">
                                <option value="1">гр</option>
                                <option value="2">мл</option>
                                <option value="3">шт</option>
                                <!-- Добавь другие единицы измерения -->
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-ingredient">Удалить</button>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-success m-3" id="addIngredient">Добавить ингредиент</button>
            <br><br>
            <button type="submit" class="btn btn-primary mx-3 mb-3">Сохранить рецепт</button>
        </form>

        <h3>Добавить новую страну</h3>
        <form method="post" class="mb-3">
            <input type="text" name="new_country" class="form-control" placeholder="Название страны" required>
            <button type="submit" class="btn btn-secondary mt-2">Добавить страну</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#addIngredient').click(function() {
            var newIngredient = `
                <div class="ingredient-row">
                    <div class="row row m-3">
                        <div class="col-md-4">
                            <input type="text" name="ingredients[]" class="form-control" placeholder="Ингредиент" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="amounts[]" class="form-control" placeholder="Количество" required>
                        </div>
                        <div class="col-md-3">
                            <select name="units[]" class="form-control">
                                <option value="1">гр</option>
                                <option value="2">мл</option>
                                <option value="3">шт</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-ingredient">Удалить</button>
                        </div>
                    </div>
                </div>`;
            $('#ingredients-list').append(newIngredient);
        });

        $(document).on('click', '.remove-ingredient', function() {
            $(this).closest('.ingredient-row').remove();
        });
    });
    </script>
</body>

</html>