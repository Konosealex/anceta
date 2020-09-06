<?php
require_once('connect.php');
include('functions.php');
session_start();
if (empty(htmlspecialchars($_COOKIE["auth"]))) {
    header("Location: ../admin/login.php");
}
$id = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title>«Административная часть»</title>
    <link href="../style.css" rel="stylesheet">
</head>
<body>
<div class="decor admin">
    <div class="form-left-decoration"></div>
    <div class="form-right-decoration"></div>
    <div class="circle"></div>
    <div class="form-inner">
            <? $query = $conn->query("SELECT * FROM allresult WHERE id=$id"); ?>
            <? if ($query->num_rows): ?>
                <? while ($row = mysqli_fetch_assoc($query)): ?>
        <h1>Детальная страница анкеты</h1>

        <table class="separate">
            <tbody>
            <thead>
            <tr>
                <th>Пол</th>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>Дата рождения</th>
                <th>Аватар</th>
                <th>Любимый цвет</th>
                <th>Личные качества</th>
                <th>Усидчивость</th>
                <th>Опрятность</th>
                <th>Самообучаемость</th>
                <th>Трудолюбие</th>
                <th>Фотографии</th>
            </tr>
            </thead>
                    <tr>
                        <td><?= $row['sex']; ?></td>
                        <td><?= $row['lastName']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['thirdName']; ?></td>
                        <td><?= $row['birthDate']; ?></td>
                        <td><?= "<img src='" . $row['avatar'] . "' width=\"60px\"/>" ?></td>
                        <td style="background:<?= $row['color']; ?>; width: 60px;"></td>
                        <td><?= $row['characters']; ?></td>
                        <td style="text-align: center" class="perseverance"><?= check_replace($row['perseverance']); ?></td>
                        <td style="text-align: center" class="neatness"><?= check_replace($row['neatness']); ?></td>
                        <td style="text-align: center" class="selflearning"><?= check_replace($row['selflearning']); ?></td>
                        <td style="text-align: center" class="hardworking"><?= check_replace($row['hardworking']); ?></td>
                        <td><?= $row['photos']; ?></td>
                    </tr>
                <? endwhile; ?>
            <?else:?>
            <?echo '<h1>Ошибка</h1>'; ?>
            <? endif; ?>
            </tbody>
        </table>
        <div class="buttons">
            <div>
                <button class="button__wrap-prev" type="button" id="prevBtn"><a href="/">Выход</a></button>
            </div>
        </div>
    </div>
</div>
</body>
<script src="script.js"></script>
</html>