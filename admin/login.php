<?php
require_once('connect.php');
include('functions.php');
session_start();
?>
<html lang="ru">
<head>
    <title>Форма авторизации</title>
    <link href="../style.css" rel="stylesheet">
</head>
<body>
<?
$link = $conn;
if (!empty($_SESSION['auth'])) {
    header("Location: ../admin/index.php");
}
if (isset($_POST['submit'])) {
    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    $query = mysqli_query($link, "SELECT user_id, user_password FROM users WHERE user_login='" . mysqli_real_escape_string($link, $_POST['login']) . "' LIMIT 1");
    $data = mysqli_fetch_assoc($query);
    // Сравниваем пароли
    if ($data['user_password'] === md5(md5($_POST['password']))) {
        // Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));
        // Записываем в БД новый хеш авторизации
        mysqli_query($link, "UPDATE users SET user_hash='" . $hash . "' WHERE user_id='" . $data['user_id'] . "'");
        // Ставим куки
        setcookie("id", $data['user_id'], time() + 60 * 60 * 24 * 30, "/");
        setcookie("hash", $hash, time() + 60 * 60 * 24 * 30, "/", null, null, true);
        // Переадресовываем браузер на страницу проверки
        header("Location: ../admin/index.php");
        exit();
    } else {
        $error = 'Ошибка авторизации';
    }
}
?>
<form class="decor" action="../admin/login.php" method="post">
    <h2>Введите логин и пароль</h2>
    <div class="form-left-decoration"></div>
    <div class="form-right-decoration"></div>
    <div class="circle"></div>
    <div class="form-inner">
        <? if (isset($error)): ?>
            <label class="login-error">
                <?= $error ?>
            </label>
        <? endif; ?>
        <label for="login">Имя пользователя: </label>
        <input type="text" name="login" id="login">
        <label for="password">Пароль: </label><input type="password" name="password" id="password">
        <input type="submit" name="submit" value="Войти">
    </div>
</form>
</body>
</html>