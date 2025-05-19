<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chat - регистрация</title>
	<link rel="stylesheet" href="/assets/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>

<div class="wrapper">
	<form action="" class="login-form">
		<h2>Регистрация</h2>
		<input placeholder="Имя пользователя" type="text" name="username" class="login-form__input">
		<input placeholder="Пароль" type="password" name="password" class="login-form__input">
		<button type="submit" class="login-form__button">Войти</button>
	</form>
</div>

<div class="warn success display-none">Вы успешно прошли регистрацию</div>
<div class="warn error display-none">Такой пользователь уже есть</div>
<div class="warn fatalerror display-none">Произошла какая-то ошибка!</div>

</body>
</html>
