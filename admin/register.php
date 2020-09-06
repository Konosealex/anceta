<?php
require_once('connect.php');
include_once('functions.php');
?>
<html lang="ru">
<head>
    <title>Форма авторизации</title>
    <link href="../style.css" rel="stylesheet">
</head>
<body>
<?
$link = $conn;
if (isset($_POST['submit'])) {
    $err = [];
    // проверям логин
    if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['login'])) {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }
    if (strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30) {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }
    // проверяем, не сущестует ли пользователя с таким именем
    $query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login='" . mysqli_real_escape_string($link, $_POST['login']) . "'");
    if (mysqli_num_rows($query) > 0) {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }
    // Если нет ошибок, то добавляем в БД нового пользователя
    if (count($err) == 0) {
        $login = $_POST['login'];
        // Убераем лишние пробелы и делаем двойное хеширование
        $password = md5(md5(trim($_POST['password'])));
        mysqli_query($link, "INSERT INTO users SET user_login='" . $login . "', user_password='" . $password . "'");
        header("Location: login.php");
        exit();
    } else {
        $errText = "<b>При регистрации произошли следующие ошибки:</b><br>";
    }
}
?>
<form class="decor" method="post">
    <h2>Введите логин и пароль</h2>
    <div class="form-left-decoration"></div>
    <div class="form-right-decoration"></div>
    <div class="circle"></div>
    <div class="form-inner">
        <? if (isset($errText)): ?>
            <label class="login-error">
                <? foreach ($err as $error): ?>
                    <? print $error . "<br>"; ?>
                <? endforeach; ?>
            </label>
        <? endif; ?>
        <label for="login">Задайте логин: </label>
        <input type="text" name="login" id="login">
        <label for="password">Задайте пароль: </label><input type="password" name="password" id="password">
        <input type="submit" name="submit" value="Зарегистрироваться">
    </div>
</form>
</body>
</html>