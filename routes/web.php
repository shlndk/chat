<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\MessageController;

return [
	['GET', '/register', [AuthController::class, 'registerForm']],
	['GET', '/login', [AuthController::class, 'loginForm']],
	['POST', '/register', [AuthController::class, 'register']],
	['POST', '/login', [AuthController::class, 'login']],
	['POST', '/logout', [AuthController::class, 'logout']],
	['GET', '/home', [HomeController::class, 'index']],
	['GET', '/', [MessageController::class, 'index']],
	['GET', '/chat', [MessageController::class, 'chat']],
	['GET', '/load', [MessageController::class, 'load']],
	['POST', '/send', [MessageController::class, 'send']],
];
