const receiverId = document.getElementById('receiverIdInput').value;

window.addEventListener('DOMContentLoaded', () => {

	fetch('/load?user_id=' + encodeURIComponent(receiverId))
		.then(res => res.text())
		.then(html => {
			document.getElementById('chatBox').innerHTML = html;
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

