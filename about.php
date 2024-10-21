<?php
session_start();
?>

<!doctype html>
<html lang="ru" class="h-100">
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
        body {
            background-color: #343a40; /* Темный фон для страницы */
            color: white; /* Белый цвет текста */
        }

        .lead {
            margin-bottom: 20px;
        }

        .vertical-photo {
            max-height: 600px; /* Увеличиваем высоту для фото */
            width: auto; /* Автоматическая ширина */
            border-radius: 15px; /* Скругленные края */
            margin-top: 20px; /* Отступ сверху */
        }

        .btn-custom {
            color: black; /* Цвет текста кнопки */
            background-color: white; /* Цвет фона кнопки */
        }
    </style>
</head>

<body>
<div class="d-flex h-100 text-center text-bg-dark">
        <div class="wrapper cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <?php include "header.php" ?>
        </div>
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-4">О нас</h1>
                <p class="lead">Это сайт <strong>ЭтноВкус</strong>, разработанный Софией Аббаси, девушкой, которая любит этническую кухню. 
                    Мы собрали здесь множество национальных рецептов, чтобы вы могли попробовать различные блюда со всего мира.</p>
                <p class="lead">Мы стремимся вдохновить вас на кулинарные эксперименты и помочь вам открыть новые вкусы. 
                    Каждый рецепт сопровождается подробными инструкциями и красивыми фотографиями, чтобы сделать процесс приготовления максимально простым и увлекательным.</p>
                <p class="lead">
                    <a href="recipe.php" class="btn btn-lg btn-custom fw-bold">К рецептам</a>
                </p>
            </div>
            <div class="col-md-6 text-center">
                <img src="images/about/Sofia.jpg" alt="София Аббаси" class="img-fluid vertical-photo"> <!-- Замените путь на ваш файл -->
            </div>
        </div>
    </div>

    <footer class="text-center mt-4">
        <p>Создано командой <strong>ЭтноВкус</strong>. <br> Связь: <a href="mailto:sonyamay74@gmail.com" class="text-white">sonyamay74@gmail.com</a>.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
