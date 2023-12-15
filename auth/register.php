<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];
	require __DIR__ . '/auth.php';
	require dirname(__DIR__) . '/util/parseColor.php';
	
	if ($login != '' || $password != ''){
		if (registerUser($login, $password)) {
			$info = replaceColors('[2Регистрация успешно завершена.] <a href="login.php">Войти</a>');
			//sleep(5);
			//header('Location: /index.php');
			echo '<script>
					setTimeout(function() {
						window.location.href = "/index.php";
					}, 1000); // Задержка в 5 секунд
				</script>';
		} else {
			$info = replaceColors('[4Пользователь с таким логином уже существует.]');
		}
	} else {
		$info = replaceColors('[4Заполнете поля.]');
	}	
}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Форма авторизации</title>
		<style>
			.input[type=text], input[type=password], input[type=submit], input[type=button] {
				//background-color: #fffff;
				border: 1px solid #808080; /* Серая граница */
				//display: block; /* Элементы ввода находятся на новой строке */
			}
			.input[type=text], input[type=password], input[type=submit], input[type=button]:focus {
				//background-color: #5a5a5a;
				border: 1px solid #808080; /* Серая граница */
				outline: none;
				//display: block; /* Элементы ввода находятся на новой строке */
			}

			.form {
				border: 2px solid #000000; /* Цвет границы и ее толщина */
				padding: 20px; /* Отступ внутри формы */
				display: inline-block; /* Размер формы подстраивается под контент */
			}
			
			//body {
			//	font-family: Arial, sans-serif;
			//	/* Дополнительные свойства шрифта, такие как размер и цвет, могут быть добавлены здесь */
			//}
		</style>
	</head>
	<body>
		<form class="form" method="post" action="register.php">
			<?php if (isset($info)): ?>
				<?php echo $info; ?>
				<br>
			<?php endif; ?>
			<label for="login">Имя пользователя(login): </label><br>
			<input class="input" type="text" name="login" id="login" style="width: 100%;"><br><br>

			<label for="password">Пароль(password): </label><br>
			<input class="input" type="password" name="password" id="password" style="width: 100%;"><br><br>

			<input class="input" type="submit" value="Зарегистрироваться"style="float: right;">
		</form>
	</body>
</html>
<!--
<div class="container"> </div>
.container {
      text-align: center;
    }
-->