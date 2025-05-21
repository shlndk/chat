<div class="accounts">
	<?php foreach ($users as $user): ?>
		<div class="account">
			<img src="/assets/images/profile.png" alt="">
			<div>
				<a href="/chat?user_id=<?=$user['id']?>"><h4><?= $user['username']; ?></h4></a>
				<span><?= $user['id']; ?></span>
			</div>
		</div>
	<?php endforeach; ?>

</div>
