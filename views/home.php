
<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/assets/style/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
	<title>Chat</title>
</head>

<body>
<div class="wrapper">
	<div class="profile">
		<div class="profile-left">
			<div class="profile-about">
				<h2>Привет, <span><?= isset($user['username']) ? htmlspecialchars($user['username']) : 'Гость' ?></span>!</h2>
				<form action="/logout" method="post">
					<button type="submit">Выйти</button>
				</form>
			</div>
			<div class="accounts">

				<div class="account">
					<img src="/assets/images/profile.png" alt="">

					<div>
						<h4>Игорь</h4>
						<span>id: 1</span>
					</div>
				</div>

				<div class="account">
					<img src="/assets/images/profile.png" alt="">

					<div>
						<h4>Игорь</h4>
						<span>id: 1</span>
					</div>
				</div>

				<div class="account">
					<img src="/assets/images/profile.png" alt="">

					<div>
						<h4>Игорь</h4>
						<span>id: 1</span>
					</div>
				</div>
			</div>
		</div>

		<div class="profile-right">

			<div class="messages">
				<div class="message my">
					Привет!
				</div>

				<div class="message buddy">
					Как дела?
				</div>
			</div>

			<form action="" method="post" class="message-form">
				<input type="text" name="message" class="message-form__input" placeholder="Введите сообщение">
				<button type="submit" class="">Отправить</button>
			</form>
		</div>

	</div>
</div>



</body>
</html>
