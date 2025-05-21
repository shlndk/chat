<?php

namespace App\Controllers;

use App\Models\Auth;
use PixelFix\Framework\Controllers\AbstractController;
use PixelFix\Framework\Database\Connection;
use PixelFix\Framework\Http\Request;
use PixelFix\Framework\Http\Response;
use App\Models\User;

class AuthController extends AbstractController
{
	private $user;
	public function __construct()
	{
		parent::__construct();
		$this->user = new User();
	}

	public function registerForm(): Response
	{
		return $this->render('register.php');
	}
	public function loginForm(){
		return $this->render('login.php');
	}
	public function register(Request $request): Response
	{

		$rules = [
			'username' => 'required',
			'email'    => 'required|email|unique:users',
			'password' => 'required|min:6',
		];

		$errors = $request->validate($_POST, $rules);


		if (empty($errors)) {

			$username = $_POST['username'];
			$email = $_POST['email'];
			$passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);

			$result = $this->user->register($username, $email, $passwordHash);

			if ($result) {
				header('Location: /login');
				exit;
			} else {
				return $this->render('register.php', ['errors' => 'Registration failed.']);
			}

		} else {
			return $this->render('register.php', ['errors' => $errors]);
		}

	}


	public function login(){

		$email = $_POST['email'];
		$password = $_POST['password'];

		$result = $this->user->login($email, $password);

		if ($result) {
			header('Location: /');
			exit;

		} else {
			return $this->render('login.php', ['errors' => 'Invalid email or password.']);
		}
	}
	public function logout()
	{
		if($_SERVER['REQUEST_METHOD'] === 'POST') {

			$result = $this->user->logout();

			header('Location: /login');
			exit;
		}else{
			http_response_code(405);
		}


	}



}
