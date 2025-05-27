const receiverId = document.getElementById('receiverIdInput').value;

window.addEventListener('DOMContentLoaded', () => {

	fetch('/load?user_id=' + encodeURIComponent(receiverId))
		.then(res => res.text())
		.then(html => {
			document.getElementById('chatBox').innerHTML = html;
		});
});
document.querySelectorAll('.account').forEach(account => {
	account.addEventListener('click', () => {
		const accountId = account.dataset.accountId;
		document.getElementById('receiverIdInput').value = accountId;
		document.getElementById('sendButton').style.display = 'inline-block';
		document.getElementById('messageInput').disabled = false;
	});
});
document.getElementById('messageForm').addEventListener('submit', function (e) {
	e.preventDefault();

	const input = document.getElementById('messageInput');
	const chatBox = document.getElementById('chatBox');
	const message = input.value;

	fetch('/send', {
		method: 'POST',
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		body: 'message=' + encodeURIComponent(message) +
			'&receiver_id=' + encodeURIComponent(receiverId)

	})
		.then(response => response.text())
		.then(html => {
			chatBox.insertAdjacentHTML('beforeend', html);
			input.value = '';

		});
});

