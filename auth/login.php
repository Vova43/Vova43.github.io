<?php
session_start();
if (isset($_SESSION['authenticated']) || $_SESSION['authenticated'] == true) {
	if (isset($_SESSION['username']) || $_SESSION['username'] == true) {
		header('Location: /index.php');
	}
}

require __DIR__ . '/captcha/captcha.php';
$captchaGenerator = new CaptchaGenerator(mt_rand(4, 8), 36, true, 20);
$captchaImg = $captchaGenerator->generateImage();
$captchaCode = $captchaGenerator->getCaptchaCode();

if (!empty($_POST)) {
    require __DIR__ . '/auth.php';
	require dirname(__DIR__) . '/util/parseColor.php';

    $login = isset($_POST['login']) ? $_POST['login'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
	
	if ($login != '' || $password != ''){
		if (checkAuth($login, $password)) {
			//header('Location: /index.php');
			$info = replaceColors('[2Авторизация успешно завершена.]');
			echo '<script>
					setTimeout(function() {
						window.location.href = "/index.php";
					}, 1000); // Задержка в 5 секунд
				</script>';
		} else {
			$info = replaceColors('[4Ошибка авторизации.]');
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
			
			body {
				//font-family: Arial, sans-serif;
				//font-size: 26px;
				/* Дополнительные свойства шрифта, такие как размер и цвет, могут быть добавлены здесь */
			}
		</style>
	</head>
	<body>
		<form class="form" method="post" action="login.php" style="background-color: rgba(90, 90, 90, 0.1);">
			<?php if (isset($info)): ?>
				<?php echo $info; ?>
				<br>
			<?php endif; ?>
			<label for="login" >Имя пользователя(login): </label><br>
			<input class="input" type="text" name="login" id="login" style="width: 100%;"><br><br>
			<label for="password">Пароль(password): </label><br>
			<input class="input" type="password" name="password" id="password" style="width: 100%;"><br><br>
			<input class="input" type="submit" value="Войти"> 
			<input class="input" type="button" value="Регистрация" style="float: right;" onclick="redirectToRegister()" > <br>
			<img src="<?php echo $captchaImg; ?>" alt="Captcha" name="captcha_img">
			<?php echo $captchaCode; ?>


		</form>

		<script>
			function redirectToRegister() {
				window.location.href = 'register.php';
			}
		</script>
	</body>
</html>