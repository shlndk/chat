<?php
require BASE_PATH . '/views/layout/header.php';


if (!empty($errors)): ?>

	<div class="error-message">
		<?= htmlspecialchars($errors) ?>
	</div>

<?php endif;
?>

<body>

<div class="wrapper">

	<form action="/login" class="login-form" method="post">
		<h2>Вход</h2>
		<input placeholder="Електронный адрес" type="text" name="email" class="login-form__input">
		<input placeholder="Пароль" type="password" name="password" class="login-form__input">
		<button type="submit" class="login-form__button">Войти</button>
	</form>

</div>

<?php
require BASE_PATH . '/views/layout/footer.php';
?>
