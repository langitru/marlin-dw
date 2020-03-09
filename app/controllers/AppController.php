<?php
namespace Controllers;

use Tamtamchik\SimpleFlash\Flash;
use League\Plates\Engine;
use Kint\Kint;
use Delight\Auth\Auth;
// use Config\Config;
use PDO;

class AppController
{
	private $views;
	private $auth;
	// protected $db;
	
	function __construct(Auth $auth, Engine $engine)
	{
		// $this->db = new PDO(Config::getDB(), Config::getUser(), Config::getPWD());
		// $this->db = $pdo;
		$this->auth = $auth;
		$this->views = $engine;
	}

	public function index()
	{
		$username = $this->auth->getUsername();
		echo $this->views->render('index', ['username' => $username]);
	}

	public static function Error($numberError)
	{
		
		$views = new Engine('../app/views');
		echo $views->render($numberError.'.error');
	}

}

