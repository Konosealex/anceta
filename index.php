<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>«Анкетирование»</title>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
    <form  class="decor" id="regForm" action="admin/form.php" method="POST" enctype="multipart/form-data">
        <div class="form-left-decoration"></div>
        <div class="form-right-decoration"></div>
        <div class="circle"></div>
            <h1>Заполнение анкеты</h1>
            <div class="tab">
                <h2>Шаг 1</h2>
                <div class="form-inner">
                    <label for="sex">Пол</label>
                    <select class="required" id="sex" name="sex">
                        <option value="" hidden="">Выберите пол</option>
                        <option value="male">Мужской</option>
                        <option value="female">Женский</option>
                    </select>

                    <label for="lastName">Фамилия</label>
                    <input class="required" type="text" id="lastName" placeholder="Введите фамилию" name="lastName" oninput="this.className = ''">

                    <label for="name">Имя</label>
                    <input type="text" id="name" placeholder="Введите имя" name="name">

                    <label for="thirdName">Отчество</label>
                    <input type="text" id="thirdName" name="thirdName" placeholder="Введите отчество">

                    <label for="birthDate">Дата рождения</label>
                    <input class="required" type="date" id="birthDate" name="birthDate" oninput="this.className = ''" >
                </div>
            </div>

            <div class="tab">
                <h2>Шаг 2</h2>
                <div class="form-inner">
                    <label for="avatar">Ваш аватар</label>
                    <input type="file" size="100000" accept=".jpg, .jpeg, .png" id="avatar" name="avatar" oninput="this.className = ''">

                    <label for="color">Любимый цвет</label>
                    <input type="color" id="color" name="color" oninput="this.className = ''">
                </div>
            </div>

            <div class="tab">
                <h2>Шаг 3</h2>
                <div class="form-inner">
                    <label for="characters">Личные качества</label>
                    <textarea id="characters" name="characters" oninput="this.className = ''"></textarea>

                    <p>Ваши навыки</p>
                    <div class="skills-wrap">
                        <label for="perseverance">Усидчивость</label>
                        <input class="checkbox" type="checkbox" id="perseverance" name="perseverance" value="1">
                    </div>

                    <div class="skills-wrap">
                        <label for="neatness">Опрятность</label>
                        <input class="checkbox" type="checkbox" id="neatness" name="neatness" value="1">
                    </div>

                    <div class="skills-wrap">
                        <label for="self-learning">Самообучаемость</label>
                        <input class="checkbox" type="checkbox" id="self-learning" name="self-learning" value="1">
                    </div>

                    <div class="skills-wrap">
                        <label for="hard-work">Трудолюбие</label>
                        <input class="checkbox" type="checkbox" id="hard-work" name="hard-work" value="1">
                    </div>
                </div>
            </div>

            <div class="tab">
                <div class="form-inner">
                    <h2>Шаг 4</h2>
                    <label for="photos">Загрузка фотографий </label>
                    <input type="file" size="100000" accept=".jpg, .jpeg, .png" id="photos" name="photos" oninput="this.className = ''">
                </div>
            </div>

        <div class="tab">
            <div class="form-inner">
                <h2>all done</h2>
            </div>
        </div>

        <div class="form-inner">
            <a href="../admin/login.php">admin panel</a>
            <div class="buttons">
                <div>
                    <button class="button__wrap-prev" type="button" id="prevBtn" onclick="nextPrev(-1)">Назад</button>
                </div>
                <div>
                    <button class="button__wrap-next" type="button" id="nextBtn" onclick="nextPrev(1)">Вперед</button>
                </div>
            </div>

            <!-- Circles which indicates the steps of the form: -->
            <div class="nav">
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
            </div>
        </div>
    </form>
    </body>
    <script src="script.js"></script>
</html>