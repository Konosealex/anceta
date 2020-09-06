<?php
session_start();
setcookie("auth", "", time() - 3600 * 24 * 30 * 12, "/", null, null, true);
session_destroy();
header('Location: ../admin/login.php');
exit;