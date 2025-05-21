<?php

namespace PixelFix\Framework\Http;

use PixelFix\Framework\Database\Connection;

class Request
{
	private static $instance = null;

	private function __construct(
		private array $server,
		private array $get,
		private array $post,
		private array $files,
		private array $cookie,
		private array $env,
		private array $session,
	) {}


	public static function create(): static
	{
		if (null === static::$instance) {
			static::$instance = new static(
				$_SERVER,
				$_GET,
				$_POST,
				$_FILES,
				$_COOKIE,
				$_ENV,
				$_SESSION ?? [],
			);
		}

		return static::$instance;
	}

	public function getMethod(): string
	{
		return $this->server['REQUEST_METHOD'];
	}

	public function getUri(): string
	{
		return $this->server['REQUEST_URI'];
	}

	public function getPostParams(string $name): string
	{
		return $this->post[$name];
	}
	public function get(string $name): string
	{
		return $this->get[$name];
	}
	public function all(): array
	{
		return $this->post;
	}
	function validate($data, $rules)
	{
		$errors = [];

		foreach ($rules as $field => $ruleStr) {
			$rulesArray = explode('|', $ruleStr);
			$value = trim($data[$field] ?? '');

			foreach ($rulesArray as $rule) {
				if ($rule === 'required' && $value === '') {
					$errors[$field][] = 'Поле обязательно для заполнения.';
				}

				if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
					$errors[$field][] = 'Некорректный email.';
				}

				if (str_starts_with($rule, 'min:')) {
					$minLength = (int) explode(':', $rule)[1];
					if (strlen($value) < $minLength) {
						$errors[$field][] = "Минимальная длина: $minLength символов.";
					}
				}
				if (str_starts_with($rule, 'unique:')) {
					$db = Connection::getConnection()->pdo;
					$table = explode(':', $rule)[1];
					$column = $field;
					$query = "SELECT COUNT(*) FROM $table WHERE $column = ?";
					$stmt = $db->prepare($query);
					$stmt->execute([$value]);

					if ($stmt->fetchColumn() > 0) {
						$errors[$field][] = 'Значение уже используется.';
					}
				}
			}
		}

		return $errors;
	}

	public function input(string $string, string $string1)
	{

	}

}
