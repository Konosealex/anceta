<?php
$conn = new mysqli('127.0.0.1', 'root', '', 'anceta');

if (mysqli_connect_errno()) {
    print_f("Соединение не установлено", mysql_connect_error());
    exit();
}
$conn->set_charset('utf8');
?>