<?php
if (!empty($_POST)) {
    require __DIR__ . '/auth.php';

    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    if (checkAuth($login, $password)) {
        setcookie('login', $login, 0, '/');
        setcookie('password', $password, 0, '/');
        header('Location: ../admin/index.php');
    } else {
        $error = 'Ошибка авторизации';
    }
}
?>
<html lang="ru">
<head>
    <title>Форма авторизации</title>
    <link href="../style.css" rel="stylesheet">
</head>
<body>
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
        <input type="submit" value="Войти">
    </div>
</form>
</body>
</html>