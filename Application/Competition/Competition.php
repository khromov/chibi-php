<?php
	//use Chibi\Core\Abs\Application_Interface;
	namespace Application\Competition;
	
	//SYND
	use Chibi\Core\Structure\ApplicationInterface 	as ApplicationInterface;
	use Chibi\Database\DB 							as DB;
	use Chibi\Router\Toro 							as Toro;
	use Chibi\Router\ToroHook						as ToroHook;
	use Chibi\Cache\Cache							as Cache;
	
	class Competition implements ApplicationInterface
	{
		var $db;
		var $config;
		var $router;
		
		public function __construct()
		{
			$config = json_decode(file_get_contents(dirname(__FILE__) . '/../config.json'), true);
			
			$this->config = $config;
			$this->db = new DB($this->config['db']['connection_string'], $this->config['db']['username'], $this->config['db']['password']);
			$this->router = new Toro();
		}
		
		/** Main application loop **/
		public function run()
		{	
			/** Setup Toro and hooks **/
			ToroHook::add("404", function()
			{
				echo '404';
				//$error_handler = new Error();
				//$error_handler->get(404);
			});

			Toro::serve
			(
				array
				(
				    "/" => "HelloWorld", //Somehow send the application state to the Controller...
			
					"/competition/:alpha" => "Competition",
				    "/c/:alpha" => "Competition",
			
				    "/about" => "About",
				),
				$this->config['site']['site_prefix'],
				$this->config['structure']['application_namespace']
			);
			
			/**
			echo Bcrypt::hash('zebra');
			
			$phpassHash = new \Phpass\Hash;
			$passwordHash = $phpassHash->hashPassword('zebra');
			echo $passwordHash;
			
			**/
		}
	}