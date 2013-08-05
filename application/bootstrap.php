<?php
	class App_Competition implements Application_Interface
	{
		var $db;
		var $config;
		var $router;
		
		public function __construct($config)
		{
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
				$error_handler = new Error();
				$error_handler->get(404);
			});

			Toro::serve(
			array(
			    "/" => "HelloWorld", //Somehow send the application state to the Controller...
		
				"/competition/:alpha" => "Competition",
			    "/c/:alpha" => "Competition",
		
			    "/about" => "About",
			), $this->config['site']['site_prefix']);
			
			/**
			echo Bcrypt::hash('zebra');
			
			$phpassHash = new \Phpass\Hash;
			$passwordHash = $phpassHash->hashPassword('zebra');
			echo $passwordHash;
			
			**/
		}
	}