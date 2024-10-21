<?php
session_start(); // Запускаем сессию

function isAdmin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin';
}

if (!isAdmin()) {
    header("Location:index.php");
    exit();
}

// Подключаем базу данных
include '../admin/database.php'; 

// Получаем общее количество рецептов
$result = $mysqli->query("SELECT COUNT(*) AS total_recipes FROM recipes");
$total_recipes = $result->fetch_assoc()['total_recipes'];

// Получаем общее количество продуктов
$result = $mysqli->query("SELECT COUNT(*) AS total_products FROM ingredients");
$total_products = $result->fetch_assoc()['total_products'];
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <script src="../assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <title>ЭтноВкус / Рецепты</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
        }
    </style>
    <link href="../assets/css/cover.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex h-100 text-center text-bg-dark">
        <div class="wrapper cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
            <?php include "../header.php"; ?>
        </div>
    </div>
    <div class="container mt-5">
        <h1 class="mb-4">Админ-панель</h1>
        <h5>Добро пожаловать, <?php echo $_SESSION["username"]; ?>!</h5> <!-- Отображение логина -->

        <!-- Кнопка выхода -->
        <form action="logout.php" method="post">
            <button type="submit" class="btn btn-danger mt-3">Выйти</button>
        </form>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-center mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Управление рецептами</h5>
                        <a href="addRecipe.php" class="btn btn-primary">Добавить рецепт</a>
                        <a href="recipeList.php" class="btn btn-danger">Удалить рецепт</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Управление граммовками</h5>
                        <a href="addWeight.php" class="btn btn-primary">Добавить граммовки</a>
                        <a href="deleteWeight.php" class="btn btn-danger">Удалить граммовки</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Статистика -->
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    <strong>Статистика:</strong> Всего рецептов: <?= $total_recipes ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
