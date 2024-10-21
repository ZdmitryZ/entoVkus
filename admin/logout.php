<?php
session_start(); // Запускаем сессию

// Удаляем все данные сессии
$_SESSION = [];

// Уничтожаем сессию
session_destroy();

// Перенаправляем на страницу логина
header("Location: ../index.php");
exit();
?>
