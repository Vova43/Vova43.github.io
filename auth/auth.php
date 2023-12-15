<?php
function checkAuth($login, $password) {
    $users = require dirname(__DIR__) . '/usersDB.php';
    foreach ($users as $user) {
        if ($user['login'] === $login && $user['password'] === $password) {
			session_start();
			$_SESSION['authenticated'] = true;
			$_SESSION['username'] = $user['login'];
			$_SESSION['logindate'] = date('d.m.Y H:i:s');
            return true;
        }
    }
    return false;
}

function registerUser($login, $password) {
    $users = require dirname(__DIR__) . '/usersDB.php';
	foreach ($users as $user) {
        if ($user['login'] === $login) {
            return false; // Логин уже занят
        }
    }
    $newUser = array(
        'login' => $login,
        'password' => $password,
    );
    $users[] = $newUser;

    $serializedUsers = var_export($users, true);
    file_put_contents(dirname(__DIR__) . '/usersDB.php', "<?php\n\nreturn $serializedUsers;\n"); 
	
	session_start();
	$_SESSION['authenticated'] = true;
	$_SESSION['username'] = $user['login'];
	
    return true;
}
?>