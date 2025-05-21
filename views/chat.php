<?php
require BASE_PATH . '/views/layout/header.php';
?>

<div class="wrapper">
	<div class="profile">
		<div class="profile-left">
			<div class="profile-about">
				<h2>Привет,
					<span><?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Гость' ?></span>!
				</h2>
				<form action="/logout" method="post">
					<button type="submit">Выйти</button>
				</form>
			</div>
			<?php require BASE_PATH . '/views/layout/accounts.php'; ?>

		</div>

		<div class="profile-right">
			<div id="chatBox">

			</div>

			<form id="messageForm" class="message-form" method="post">
				<input type="hidden" name="receiver_id" id="receiverIdInput"
					   value="<?= htmlspecialchars($_GET['user_id'] ?? '') ?>">
				<input type="text" name="message" id="messageInput" class="message-form__input"
					   placeholder="Введите сообщение">
				<button type="submit" class="">Отправить</button>
			</form>

		</div>
	</div>
</div>

	<script src='/assets/js/chat.js'></script>

<?php
require BASE_PATH . '/views/layout/footer.php';
?>



