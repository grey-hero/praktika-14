<?php 
require_once 'functions.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Демо-версия сайта для SPA-салона</title>
	<link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<style>
</style>
<body>
	<div class="formbox">
		<form method="post">
			<?php 
			if (isset($_POST['login'])){
				if (checkPassword($_POST['login'], $_POST['password'])) {
					?>
					<p style="margin-bottom: 10px;">Успешный вход.</p>
					<?
				}else{
					?>
					<p style="margin-bottom: 10px;">Неудачный вход.</p>
					<input name="login" type="text" placeholder="Логин">
					<input name="password" type="password" placeholder="Пароль">
					<input name="submit" type="submit" value="Войти">
					<?
				}
			}else{
				?>				
				<input name="login" type="text" placeholder="Логин">
				<input name="password" type="password" placeholder="Пароль">
				<input name="submit" type="submit" value="Войти">
				<?
			} ?>

			<a href="index.php">На главную</a>
		</form>
	</div>
</body>
</html>