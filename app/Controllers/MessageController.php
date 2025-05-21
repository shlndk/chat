<?php

namespace App\Controllers;


use App\Models\Message;
use PDO;
use PixelFix\Framework\Controllers\AbstractController;
use PixelFix\Framework\Database\Connection;
use PixelFix\Framework\Http\Request;
use PixelFix\Framework\Http\Response;


class MessageController extends AbstractController
{
	private $message;
	public function __construct()
	{
		parent::__construct();
		$this->message = new Message();
	}
	public function index(Request $request): Response
	{

		$messages = $this->message->getMessage();
		$users = $this->message->users();

		ob_start();
		include BASE_PATH . '/views/chat.php';
		$html = ob_get_clean();

		return new Response($html);
	}
	public function chat(Request $request): Response
	{
		if (!isset($_SESSION['user_id'])) {
			return new Response('Вы не авторизованы', 403);
		}

		$currentUserId = $_SESSION['user_id'];
		$receiverId = (int) ($_GET['user_id'] ?? 0);

		$receiver = $this->message->receiver($receiverId);

		if (!$receiver) {
			return new Response('Пользователь не найден', 404);
		}

		$users = $this->message->users();

		ob_start();
		include BASE_PATH . '/views/chat.php'; // тот же шаблон
		$html = ob_get_clean();

		return new Response($html);
	}


	public function load(Request $request): Response
	{
		$currentUserId = $_SESSION['user_id'];
		$receiverId = (int) ($_GET['user_id'] ?? 0);

		$messages = $this->message->getPrivateMessage($currentUserId, $receiverId);

		$html = '';
		foreach ($messages as $msg) {
			$html .= '<div class="message">
            <strong>' . htmlspecialchars($msg['username']) . '</strong>: ' .
				htmlspecialchars($msg['text']) . '
            <small>' . date('H:i', strtotime($msg['time'] . ' +1 hour')) . '</small>
        </div>';
		}

		return new Response($html);
	}

	public function send(Request $request): Response
	{

		if (!isset($_SESSION['user_id'])) {
			return new Response('Вы не авторизованы', 403);
		}

		$sender_id = $_SESSION['user_id'];
		$receiver_id = (int) ($_POST['receiver_id'] ?? 0);
		$message = trim($_POST['message'] ?? '');

		if (!$receiver_id || !$message) {
			return new Response('Неверные данные', 400);
		}



		$this->message->send($sender_id, $receiver_id, $message);

		$user = $_SESSION['username'];
		return new Response(
			'<div class="message">
            			<strong>' . htmlspecialchars($user) . '</strong>: ' . htmlspecialchars($message) . '
        			</div>'
		);

	}
}
