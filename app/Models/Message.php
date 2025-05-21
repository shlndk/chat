<?php

namespace App\Models;

use PDO;
use PixelFix\Framework\Database\Connection;

class Message
{
	private $db;

	public function __construct() {
		$this->db = Connection::getConnection()->pdo;
	}

	public function getMessage(){

		$stmt = $this->db->query("
    		SELECT messages.text, messages.time, messages.sender_id, users.username
    		FROM messages
    		JOIN users ON messages.sender_id = users.id
    		ORDER BY messages.id ASC
		");

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);


	}
	public function users()
	{
		return  $this->db->query("SELECT id, username FROM users")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function receiver($receiverId)
	{
		$stmt = $this->db->prepare("SELECT id, username FROM users WHERE id = ?");
		$stmt->execute([$receiverId]);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	public function current($currentUserId)
	{
		$stmt = $this->db->prepare("SELECT id, username FROM users WHERE id != ?");
		$stmt->execute([$currentUserId]);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	public function getPrivateMessage(int $currentUserId, int $receiverId){

		$stmt = $this->db->prepare("
        SELECT messages.text, messages.time, users.username
        FROM messages
        JOIN users ON messages.sender_id = users.id
        WHERE (sender_id = :me AND receiver_id = :other)
           OR (sender_id = :other AND receiver_id = :me)
        ORDER BY messages.id ASC
    ");
		$stmt->execute([
			':me' => $currentUserId,
			':other' => $receiverId
		]);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	public function send(int $sender_id, int $receiver_id, string $message){
		$stmt = $this->db->prepare("INSERT INTO messages (sender_id, receiver_id, text) VALUES (?, ?, ?)");
		$stmt->execute([$sender_id, $receiver_id, $message]);
	}


}
