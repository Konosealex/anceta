<?php
include_once('connect.php');

function pars($var, $die = true)
{
    $backtrace = debug_backtrace();
    echo '<pre>' . $backtrace[0]['file'] . ' on line ' . $backtrace[0]['line'] . '</pre>';
    echo '<pre>';
    var_dump($var);

    if ($die) {
        die("---END---");
    }
}

function get_image_path($filename, $folder)
{
    $avatarFolder = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;
    $avatarFile = $avatarFolder . $filename . " ";
    $avatarSlashLol = '/';
    $avatarWebPath = str_replace(DIRECTORY_SEPARATOR, $avatarSlashLol, $avatarFile);
    return mb_substr($avatarWebPath, 13);
}

function check_replace($string)
{
    if ($string == 1) {
        $checked = '&check;';
        return str_replace(1, $string, $checked);
    } else {
        $unchecked = '&#10007;';
        return str_replace(0, $string, $unchecked);
    }
}

function sex_replace($string)
{
    if ($string == 'male') {
        $sex = 'Мужчина';
        return str_replace('male', $string, $sex);
    } else {
        $sex = 'Женщина';
        return str_replace('female', $string, $sex);
    }
}

function get_nav_list($count_item, $page, $per_page, $second_param = '', $url = '')
{
    $adjacents = 2; // количество страниц, отделённые по краям
    $page = intval($page) ? intval($page) : 1; // текущая страница
    $prev = $page - 1; // предыдущая
    $next = $page + 1; // следующая
    $lastpage = ceil($count_item / $per_page); // последняя страница
    $prevLastpage = $lastpage - 1; // предпоследняя страница
    // Удалим возможно переданный параметр "p" из строки $second_param
    parse_str($queryString, $qstr);
    unset($qstr['p']);
    $second_param = http_build_query($qstr);

    $visibleCountPages = 5; // количество страниц от краёв, после которых будут обрезаться лишние
    $minPaginPages = $visibleCountPages + $adjacents * 2; // минимальное количество страниц для построения паджинации
    $leftMarginPages = $visibleCountPages;
    $rightMarginPages = $lastpage - $visibleCountPages + 1;

    $pagination = '';
    $hiddenSpace = "<li><span>...</span></li>";

    if ($lastpage > 1) {
        $pagination .= "<ul class='pagination'>";

        // Кнопки "Первая" и "Предыдущая"
        if ($page != 1) {
            //                $pagination .= "<li class='pagination__first'><a href='{$url}?{$second_param}&p=1'>&nbsp;</a></li>";
            $pagination .= "<li><a class='button-prev' href='{$url}?{$second_param}&p={$prev}'>&nbsp;</a></li>";
        } else {
            //                $pagination .= "<li class='pagination__first disabled'><a onclick='javascript:return false;' href='#'>&nbsp;</a></li>";
            $pagination .= "<li class='disabled'><a class='button-prev' href='#'>&nbsp;</a></li>";
        }

        // Недостаточно страниц, чтобы обрезать
        if ($lastpage <= $minPaginPages) {
            for ($counter = 1; $counter <= $lastpage; $counter++) {
                $classActive = $counter == $page ? 'class="pagin-active"' : '';
                $pagination .= "<li><a {$classActive} href='{$url}?{$second_param}&p={$counter}'>{$counter}</a></li>";
            }
        } // Страниц достаточно, чтобы обрезать и прятать часть
        else {
            // Левая граница. Обрезается правая часть
            if ($page < $leftMarginPages) {
                for ($counter = 1; $counter <= $visibleCountPages; $counter++) {
                    $classActive = $counter == $page ? 'class="active"' : '';
                    $pagination .= "<li {$classActive}><a href='{$url}?{$second_param}&p={$counter}'>{$counter}</a></li>";
                }
                $pagination .= $hiddenSpace;
                $pagination .= "<li><a href='{$url}?{$second_param}&p={$prevLastpage}'>{$prevLastpage}</a></li>";
                $pagination .= "<li><a href='{$url}?{$second_param}&p={$lastpage}'>{$lastpage}</a></li>";
            } // Правая граница. Обрезается левая часть
            elseif ($page > $rightMarginPages) {
                $pagination .= "<li><a href='{$url}?{$second_param}&p=1'>1</a></li>";
                $pagination .= "<li><a href='{$url}?{$second_param}&p=2'>2</a></li>";
                $pagination .= $hiddenSpace;
                for ($counter = $rightMarginPages; $counter <= $lastpage; $counter++) {
                    $classActive = $counter == $page ? 'class="active"' : '';
                    $pagination .= "<li {$classActive}><a href='{$url}?{$second_param}&p={$counter}'>{$counter}</a></li>";
                }
            } // Центр. Навигация обрезается по краям
            else {
                $pagination .= "<li><a href='{$url}?{$second_param}&p=1'>1</a></li>";
                $pagination .= "<li><a href='{$url}?{$second_param}&p=2'>2</a></li>";
                $pagination .= $hiddenSpace;
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    $classActive = $counter == $page ? 'class="active"' : '';
                    $pagination .= "<li {$classActive}><a href='{$url}?{$second_param}&p={$counter}'>{$counter}</a></li>";
                }
                $pagination .= $hiddenSpace;
                $pagination .= "<li><a href='{$url}?{$second_param}&p={$prevLastpage}'>{$prevLastpage}</a></li>";
                $pagination .= "<li><a href='{$url}?{$second_param}&p={$lastpage}'>{$lastpage}</a></li>";
            }
        }

        // Кнопки "Последняя" и "Следующая"
        if ($page != $lastpage) {
            $pagination .= "<li><a class='button-after' href='{$url}?{$second_param}&p={$next}'>&nbsp;</a></li>";
        } else {
            $pagination .= "<li class='disabled'><a class='button-after' href='#'>&nbsp;</a></li>";
        }

        $pagination .= "</ul>";
    }

    return $pagination;
}

function get_nav_list_res()
{
    $curPageStr = $_SERVER['REQUEST_URI'];
    $curPage = substr($curPageStr, -1);
    $conn = new mysqli('127.0.0.1', 'root', '', 'anceta');
    $r = $conn->query("SELECT COUNT(*) FROM allresult");
    $result = $r->fetch_array();
    $count_item = $result["COUNT(*)"];
    list($path, $queryString) = explode('?', $_SERVER['REQUEST_URI']);
    return get_nav_list($count_item, $curPage, 2, $queryString, $path);
}

function generateCode($length = 6)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
        $code .= $chars[mt_rand(0, $clen)];
    }
    return $code;
}

function massPhotoLoader ($input_name, $path, $photosUploadFolder)
{
// Разрешенные расширения файлов.
    $allow = array('jpg', 'jpeg', 'png');

    if (isset($_FILES[$input_name])) {
        // Преобразуем массив $_FILES в удобный вид для перебора в foreach.
        $files = array();
        $diff = count($_FILES[$input_name]) - count($_FILES[$input_name], COUNT_RECURSIVE);
        if ($diff == 0) {
            $files = array($_FILES[$input_name]);
        } else {
            foreach ($_FILES[$input_name] as $k => $l) {
                foreach ($l as $i => $v) {
                    $files[$i][$k] = $v;
                }
            }
        }

        foreach ($files as $file) {

            $photosCount = count($files);
            $arRes['count'] = $photosCount;
            if(($arRes['count']) > 5) {
                die(require 'error.php');
            }
            $arRes['size'] = filesize($file["tmp_name"]);
            if(($arRes['size']) > 1000000) {
                die(require 'error.php');
            }

            // Оставляем в имени файла только буквы, цифры и некоторые символы.
            $pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
            $name = mb_eregi_replace($pattern, '-', $file['name']);
            $name = mb_ereg_replace('[-]+', '-', $name);
            // Т.к. есть проблема с кириллицей в названиях файлов (файлы становятся недоступны).
            // Сделаем их транслит:
            $converter = array(
                'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e',
                'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k',
                'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r',
                'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
                'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ь' => '', 'ы' => 'y', 'ъ' => '',
                'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

                'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
                'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I', 'Й' => 'Y', 'К' => 'K',
                'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R',
                'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
                'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch', 'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
                'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
            );

            $name = strtr($name, $converter);
            $parts = pathinfo($name);

            if (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
                die(require 'error.php');
            } else {
                // Чтобы не затереть файл с таким же названием, добавим префикс.
                $i = 0;
                $prefix = '';
                while (is_file($path . $parts['filename'] . $prefix . '.' . $parts['extension'])) {
                    $prefix = '(' . ++$i . ')';
                }
                $name = $parts['filename'] . $prefix . '.' . $parts['extension'];
                // Перемещаем файл в директорию.
                move_uploaded_file($file['tmp_name'], $path . $name);
                $total .= get_image_path($name, $photosUploadFolder);
            }
        }
    }
    $arPhotos = explode(" ", $total);
    $test1 = array_pop($arPhotos);
    return $arPhotos;
}