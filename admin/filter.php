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
        <h1>Фильтр списка анкет</h1>
        <form class="decor" id="regForm" action="" method="POST" enctype="multipart/form-data">
            <table class="separate">
                <tr>
                    <td>
                        <label for="perseverance">Усидчивость</label>
                        <input class="checkbox" type="checkbox" id="perseverance" name="perseverance">
                    </td>
                    <td>
                        <label for="neatness">Опрятность</label>
                        <input class="checkbox" type="checkbox" id="neatness" name="neatness">
                    </td>
                    <td>
                        <label for="self-learning">Самообучаемость</label>
                        <input class="checkbox" type="checkbox" id="self-learning" name="self-learning">
                    </td>
                    <td>
                        <label for="hard-work">Трудолюбие</label>
                        <input class="checkbox" type="checkbox" id="hard-work" name="hard-work">
                    </td>
                <tr>
            </table>
            <div class="form-inner">
                <input type="submit" value="Отфильтровать">
                <?
                if (isset($_POST["perseverance"])) {
                    $arguments[] = "perseverance!='0'";
                }
                else {
                    $arguments[] = "perseverance='0'";
                }
                if (isset($_POST["neatness"])) {
                    $arguments[] = "neatness!='0'";
                }
                else {
                    $arguments[] = "neatness='0'";
                }
                if (isset($_POST["self-learning"])) {
                    $arguments[] = "selflearning!='0'";
                }
                else {
                    $arguments[] = "selflearning='0'";
                }
                if (isset($_POST["hard-work"])) {
                    $arguments[] = "hardworking!='0'";
                }
                else {
                    $arguments[] = "hardworking='0'";
                }
                if(!empty($arguments)) {
                    $str = implode(' and ', $arguments);
                } ?>
            </div>
        </form>

        <table class="separate hide">
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
            <? $query = $conn->query("SELECT * FROM allresult WHERE " . $str . " "); ?>
            <? $rows = mysqli_num_rows($query); ?>
                <? if ($rows > 0): ?>
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
            <?else:?>
            <h2 class="error">Не найдено записей удовлетворяющих фильтру</h2>
            <? endif; ?>
            </tbody>
        </table>
        <div class="buttons">
            <div>
                <button class="button__wrap-prev" type="button" id="prevBtn"><a href="index.php">К списку анкет</a></button>
            </div>
            <div>
                <button class="button__wrap-next" type="button" id="nextBtn"><a href="/">Выход</a></button>
            </div>
        </div>
    </div>
</div>
</body>
<script src="script.js"></script>
</html>