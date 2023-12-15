<?php
session_start(); // Начать сессию
$_SESSION['authenticated'] = false; // Разлогинить пользователя
$_SESSION['username'] = ''; // Сбросить username пользователя
$_SESSION['logindate'] = ''; // Сбросить logindate пользователя
session_destroy(); // Закрыть сессию
header('Location: /auth/login.php');
exit;
?>