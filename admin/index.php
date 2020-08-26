<?php
require_once('connect.php');
include('functions.php');
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
        <?
        if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
            $query = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '" . intval($_COOKIE['id']) . "' LIMIT 1");
            $userdata = mysqli_fetch_assoc($query);

            if (($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])) {
                setcookie("id", "", time() - 3600 * 24 * 30 * 12, "/");
                setcookie("hash", "", time() - 3600 * 24 * 30 * 12, "/", null, null, true); // httponly !!!
                $err = '<p>Хм, что-то не получилось</p>';
            } else {
                $ok = "<p>Привет, " . $userdata['user_login'] . ".</p>";
            }
        } ?>
        <h1>Список анкет</h1>
        <?= $ok ?>
        <?= $err ?>
        <table class="separate">
            <thead>
            <tr>
                <th>Пол</th>
                <th class="sorting">Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th class="sorting">Дата рождения</th>
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
            <tbody>
            <? $countView = 2;
            if (isset($_GET['p'])) {
                $pageNum = (int)$_GET['p'];
            } else {
                $pageNum = 1;
            }
            $startIndex = ($pageNum - 1) * $countView; // с какой записи начать выборку
            $query = $conn->query("SELECT * FROM allresult LIMIT $countView OFFSET $startIndex"); ?>
            <? $query = $conn->query("SELECT * FROM allresult LIMIT $countView OFFSET $startIndex"); ?>
            <? if ($query): ?>
                <? while ($row = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><?= $row['sex']; ?></td>
                        <td class="link"><a href="detail.php?id=<?= $row['id'] ?>"
                                            title="Переход на детальную страницу"><?= $row['lastName']; ?></a></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['thirdName']; ?></td>
                        <td><?= $row['birthDate']; ?></td>
                        <td><?= "<img src='" . $row['avatar'] . "' width=\"60px\"/>" ?></td>
                        <td style="background:<?= $row['color']; ?>; width: 60px;"></td>
                        <td><?= $row['characters']; ?></td>
                        <td style="text-align: center"
                            class="perseverance"><?= check_replace($row['perseverance']); ?></td>
                        <td style="text-align: center" class="neatness"><?= check_replace($row['neatness']); ?></td>
                        <td style="text-align: center"
                            class="selflearning"><?= check_replace($row['selflearning']); ?></td>
                        <td style="text-align: center"
                            class="hardworking"><?= check_replace($row['hardworking']); ?></td>
                        <td><?= $row['photos']; ?></td>
                    </tr>
                <? endwhile; ?>
            <? endif; ?>
            </tbody>
        </table>
        <div class="pagination-wrapper">
            <?= get_nav_list_res(); ?>
        </div>
        <div class="buttons">
            <div>
                <button class="button__wrap-prev" type="button" id="prevBtn"><a href="/">Выход</a></button>
            </div>
            <div>
                <button class="button__wrap-next" type="button" id="nextBtn"><a href="filter.php">Фильтр анкет</a>
                </button>
            </div>
        </div>
    </div>
</div>
</body>
<script src="script.js"></script>
</html>