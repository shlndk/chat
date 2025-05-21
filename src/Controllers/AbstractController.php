<?php

namespace PixelFix\Framework\Controllers;

use PixelFix\Framework\Database\Connection;
use PixelFix\Framework\Http\Request;
use PixelFix\Framework\Http\Response;
use App\Models\User;
abstract class AbstractController
{
	public function __construct()
	{
		session_start();

		if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
			$userModel = new User();
			$userModel->loginWithRememberToken($_COOKIE['remember_token']);
		}
	}
	protected ?Request $request = null;
	public function render(string $template, ?array $vars = []): Response
	{
		$templatePath = BASE_PATH . '/views/' . $template;

		if (!file_exists($templatePath)) {
			throw new \RuntimeException("Шаблон не найден: $templatePath");
		}


		extract($vars);


		ob_start();
		include $templatePath;
		$content = ob_get_clean();

		return new Response($content);
	}

	public function setRequest(Request $request): void
	{
		$this->request = $request;
	}
}
