<?php
//require __DIR__ . '/auth/auth.php';
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] == false) {
    // Перенаправление на страницу входа, если пользователь не аутентифицирован
    header('Location: auth/login.php');
    exit;
}
$login = $_SESSION['username'];
$logindate = $_SESSION['logindate']; 
require __DIR__ . '/util/parseColor.php';
echo replaceColorsTwo('[27test1] [24test1 F1] ');
//echo preg_replace_callback('/\[(\w)(\w)(.*?)\]/', 'replaceColors', '[91test1] [62test2]');
?>
<html>
<head>
	<meta charset="UTF-8">
    <title>Главная страница</title>
</head>
<body>
	<?= $login === null ? replaceColors('<a href="auth/login.php">Авторизуйтесь</a>') : replaceColors("[6Добро пожаловать], [2$login] [6$logindate] <br> <a href='auth/logout.php'>Выйти</a>"); ?>
	
</body>
</html>