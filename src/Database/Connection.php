<?php

namespace PixelFix\Framework\Database;

use PDO;

class Connection
{
	private static $instance = null;
	public ?PDO $pdo = null;

	private function __construct(string $connectionString, string $username, string $password)
	{
		$this->pdo = new PDO($connectionString, $username, $password);
	}

	public static function create(string $connectionString, string $username, string $password): static
	{
		if (null === static::$instance) {
			static::$instance = new static($connectionString, $username, $password);
		}

		return static::$instance;
	}

	public static function getConnection(): static
	{
		return static::$instance;
	}
}

