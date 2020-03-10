<?php
namespace Controllers;


use Delight\Auth\Auth;
use League\Plates\Engine;
use Tamtamchik\SimpleFlash\Flash;
use Models\UserModel;
// use Controllers\AppController;


class UserController extends AppController
{
	// private $db;
	// private $params;
	private $views;
	private $auth;
	
	function __construct(Auth $auth, Engine $engine)
	{

		// $this->db = $qb;
		$this->auth = $auth;
		// $this->auth = new Auth($this->db->getPDO());
		$this->views = $engine;
	}



	public function signup()
	{
		// d($_SERVER['HTTP_HOST']);die;
		echo $this->views->render('signup.user');
	}

	public function signupHandler()
	{

		try {
		    $userId = $this->auth->register($_POST['email'], $_POST['password'], $_POST['username'], function ($selector, $token) {
		        Flash::message('Новый пользователь успешно зарегистрирован! <br>
		        				Для авторизации пользователя, подтвердите Email: <br>
		        				http://'.$_SERVER['HTTP_HOST'].'/verify_email?selector=' . \urlencode($selector) . '&token=' . \urlencode($token), 'success');
			    header('location: /');
		        // echo 'http://phpshka.loc/verify_email?selector=' . \urlencode($selector) . '&token=' . \urlencode($token);
		    });

		    // echo '<br>We have signed up a new user with the ID ' . $userId;
		}
		catch (\Delight\Auth\InvalidEmailException $e) {
		    die('Invalid email address');
		}
		catch (\Delight\Auth\InvalidPasswordException $e) {
		    die('Invalid password');
		}
		catch (\Delight\Auth\UserAlreadyExistsException $e) {
		    die('User already exists');
		}
		catch (\Delight\Auth\TooManyRequestsException $e) {
		    die('Too many requests');
		}		
	}	

	public function signin()
	{
		echo $this->views->render('signin.user');
	}

	public function signinHandler()
	{
		try {
		    $this->auth->login($_POST['email'], $_POST['password']);
		    Flash::message('Вы успешно авторизовались', 'success');
		    header('location: /');
		}
		catch (\Delight\Auth\InvalidEmailException $e) {
		    die('Wrong email address');
		}
		catch (\Delight\Auth\InvalidPasswordException $e) {
		    die('Wrong password');
		}
		catch (\Delight\Auth\EmailNotVerifiedException $e) {
		    die('Email not verified');
		}
		catch (\Delight\Auth\TooManyRequestsException $e) {
		    die('Too many requests');
		}
	}

	public function logout()
	{
		$this->auth->logOut();
		$this->auth->destroySession();
		header('location: /');
	}

	public function verify_email()
	{
		try {
		    $this->auth->confirmEmail($_GET['selector'], $_GET['token']);
		    Flash::message('Email успешно подтвержден!', 'success');
		    header('location: /');
		}
		catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
		    die('Invalid token');
		}
		catch (\Delight\Auth\TokenExpiredException $e) {
		    die('Token expired');
		}
		catch (\Delight\Auth\UserAlreadyExistsException $e) {
		    die('Email address already exists');
		}
		catch (\Delight\Auth\TooManyRequestsException $e) {
		    die('Too many requests');
		}
	}

	public function getUsers()
	{
		$username = $this->auth->getUsername();
		if ($username)
		{
			$users = new UserModel();
			$array_users = $users->getAll('users');
			// var_dump($users2);
			echo $this->views->render('index.user', ['users' => $array_users, 'username' => $username]);
		} else {
			// echo $this->views->render('index.user', ['username' => $username]);
			Flash::message('Вы не авторизованы! Доступ запрещен!', 'warning');
			header('location: /');
		}
		
	}

}
