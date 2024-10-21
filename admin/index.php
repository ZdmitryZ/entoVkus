<?php
session_start(); // Начинаем сессию
$val = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include "database.php"; // подключаем базу данных

    $login = $_POST['login'];
    $password = $_POST['password'];
	// var_dump($_POST);

    // Подготовленный запрос для проверки логина
    $sql = "SELECT * FROM admins WHERE admin_login = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $login);
    $stmt->execute();
    $result = $stmt->get_result();

    $user = $result->fetch_assoc();
	var_dump($user);
    if ($user) {
        // Проверяем пароль с использованием password_verify
        if ($password ==  $user["admin_password"]) {
            // Успешная авторизация
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_role"] = "admin";
            $_SESSION["username"] = $user['admin_login'];

            header("Location: /admin/adminPage.php"); // Перенаправление на страницу администратора
            exit;
        } else {
            $val = true; // Неверный пароль
        }
    } else {
        $val = true; // Пользователь не найден
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="login.css">
    <title>Admin | этноВкус</title>
</head>
<body>
    <?php if ($val): ?>
        <em>Неверный логин или пароль</em>
    <?php endif; ?>
    <form method="post">
        <div class="login-box">
            <h1>Login</h1>
            <div class="textbox">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="text" placeholder="Username" name="login" value="">
            </div>
            <div class="textbox">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" placeholder="Password" name="password" value="">
            </div>
            <button class="button" type="submit" name="btn" value="Sign In">Вход</button>
        </div>
    </form>
</body>
</html>
