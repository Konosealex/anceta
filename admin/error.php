<?php
require_once('connect.php');
include_once('functions.php');

$maxavatarsize = 100000;
$maxfiles = 5;
$maxphotosize = 1024 *1024;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>«Анкетирование»</title>
    <link href="../style.css" rel="stylesheet">
</head>
<body>
    <div class="decor">
        <div class="form-left-decoration"></div>
        <div class="form-right-decoration"></div>
        <div class="circle"></div>
        <div class="form-inner">
            <?if ((($_POST['sex']) == "") || (($_POST['lastName']) == "") || (($_POST['birthDate']) == "")): ?>
            <h1>Не все данные введены.<br>
                Пожалуйста, вернитесь назад и закончите ввод</h1>
            <?endif;?>
            <?if (($_FILES['avatar']['size']) > $maxavatarsize):?>
                <h1>Размер файла превышает 100 кб!</h1>
            <?endif;?>
            <?if ((count($_FILES['photos']['name'])) > $maxfiles):?>
                <h1>Вы пытаетесь загрузить больше 5 файлов!</h1>
            <?endif;?>
            <?foreach ($_FILES['photos']['tmp_name'] as $name):?>
                <?if((filesize($name)) > $maxphotosize):?>
                    <h1>Размер файла <?=$name?> превышает 1 мб!</h1>
                <?endif;?>
            <?endforeach;?>
            <?if (!empty($allow)):?>
            <h1>Запрещенное расширение файла!</h1>
            <?endif;?>
            <div class="buttons">
                <div>
                    <button class="button__wrap-prev" type="button" id="prevBtn" onclick="history.back()">Назад</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../script.js"></script>
</html>