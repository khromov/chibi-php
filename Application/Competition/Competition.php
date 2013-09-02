<?php
	namespace Application\Competition;
	
	//FIXME: Any way to do this nicer?
	use Chibi\Core\Structure\ApplicationInterface 	as ApplicationInterface;
	use Chibi\Database\DB 							            as DB;
	use Chibi\Router\Toro 							            as Toro;
	use Chibi\Router\ToroHook						            as ToroHook;
	//use Chibi\Cache\CacheManager							    as CacheManager;
	
	class Competition implements ApplicationInterface
	{
		var $db;
		var $config;
		var $router;
		
		public function __construct()
		{
			$config = json_decode(file_get_contents(dirname(__FILE__) . '/config.json'), true);

			$this->config = $config;
			$this->db = new DB($this->config['db']['connection_string'], $this->config['db']['username'], $this->config['db']['password']);
			$this->router = new Toro();
			
			//Configure cache
			//TODO: Should this be done from config or like this? Check how Symfony2 does it.
			$this->cache = new \Chibi\Cache\Drivers\Dummy();
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