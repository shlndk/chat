<?php

namespace App\Controllers;

use App\Models\Book;
use PixelFix\Framework\Controllers\AbstractController;
use PixelFix\Framework\Http\Response;

class AuthController extends AbstractController
{
	public function register(): Response
	{
		return $this->render('register.html');
	}

	public function create(): Response
	{
		return $this->render('create-book.html.twig');
	}

	public function store(): void
	{
		$book = new Book();
		$book->setTitle($this->request->getPostParams('title'));
		$book->setBody($this->request->getPostParams('body'));

		$book->save();

		dd($book);
	}
}
