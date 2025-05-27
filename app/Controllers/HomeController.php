<?php

namespace App\Controllers;

use PixelFix\Framework\Controllers\AbstractController;
use PixelFix\Framework\Database\Connection;
use PixelFix\Framework\Http\Request;
use PixelFix\Framework\Http\Response;
use App\Models\User;

class HomeController extends AbstractController
{
	public function index(){
		return $this->render('home.php');
	}



}
