<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;

return [
	['GET', '/', [HomeController::class, 'index']],
	['GET', '/register', [AuthController::class, 'register']],
];
