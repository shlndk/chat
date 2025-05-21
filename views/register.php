<?php
require BASE_PATH . '/views/layout/header.php';


if (!empty($errors)): ?>
	<?php foreach ($errors as $fieldErrors): ?>
		<?php foreach ($fieldErrors as $error): ?>
			<div class="error-message"><?= htmlspecialchars($error) ?></div>
		<?php endforeach; ?>
	<?php endforeach; ?>
<?php endif;
?>

<body>

<div class="wrapper">
	<form action="/register" class="login-form" method="post">
		<h2>Регистрация</h2>
		<input placeholder="Имя пользователя" type="text" name="username" class="login-form__input">
		<input placeholder="Електронный адрес" type="email" name="email" class="login-form__input">
		<input placeholder="Пароль" type="password" name="password" class="login-form__input">
		<button type="submit" class="login-form__button">Регистрация</button>
	</form>
</div>

<?php
require BASE_PATH . '/views/layout/footer.php';
?>
