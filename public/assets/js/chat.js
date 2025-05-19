document.getElementById('messageForm').addEventListener('submit', function (e) {
	e.preventDefault();

	const input = document.getElementById('messageInput');
	const chatBox = document.getElementById('chatBox');
	const message = input.value;

	fetch('/send', {
		method: 'POST',
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		body: 'message=' + encodeURIComponent(message)
	})
		.then(response => response.text())
		.then(html => {
			chatBox.innerHTML += html;
			input.value = '';
			chatBox.scrollTop = chatBox.scrollHeight;
		});
});

