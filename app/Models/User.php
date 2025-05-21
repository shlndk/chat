<?php

namespace App\Models;

use PixelFix\Framework\Database\Connection;

class User
{
	private $db;

	public function __construct() {
		$this->db = Connection::getConnection()->pdo;
	}

	public function loginWithRememberToken($token)
	{

		$stmt = $this->db->prepare("SELECT * FROM users WHERE remember_token = :token");
		$stmt->bindParam(':token', $_COOKIE['remember_token']);
		$stmt->execute();

		$user = $stmt->fetch();

		if ($user) {
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['username'] = $user['username'];
			return true;
		}

		return false;
	}
	public function register($username, $email, $passwordHash)
	{
		try{
			$stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':password', $passwordHash);
			return $stmt->execute();
		}catch (\PDOException $e) {
			return false;
		}

	}

	public function login($email, $password)
	{
		$stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		$user = $stmt->fetch();

		if ($user && password_verify($password, $user['password'])) {
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['username'] = $user['username'];
			$token = bin2hex(random_bytes(32));
			$stmt = $this->db->prepare("UPDATE users SET remember_token = :token WHERE id = :id");
			$stmt->execute([
				':token' => $token,
				':id' => $user['id'],
			]);


			setcookie("remember_token", $token, [
				'expires' => time() + (30 * 24 * 60 * 60),
				'path' => '/',
				'secure' => true,
				'httponly' => true,
				'samesite' => 'Lax'
			]);
			return true;
		}
		return false;
	}
	public function logout(){

		if (isset($_SESSION['user_id'])) {
			$stmt = $this->db->prepare("UPDATE users SET remember_token = NULL WHERE id = :id");
			$stmt->execute([':id' => $_SESSION['user_id']]);
		}

		// Удаляем куку
		setcookie("remember_token", "", time() - 3600, "/");

		session_unset();
		session_destroy();
	}



}
