<?php
	class Controller
	{
		var $app;
		
		function __construct()
		{
			global $app;
			$this->app = &$app; //Pass app to the Controller by reference
		}
		
		public static function getAppInstance() //Return by reference
		{
			global $app;
			return $app;
		}
	}