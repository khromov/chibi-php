<?php
	namespace Chibi;
	
	class Chibi
	{
		function __construct()
		{	
			/** \Chibi\Common\IsolatedClassLoader => /path/to/project/lib/vendor/Doctrine/Common/IsolatedClassLoader.php 
				 * Load our required conig classes
				 */
				 //TODO: Is .php file better after all? (Performance?)
				$config = json_decode(file_get_contents('application/config.json'), true);
				//require('application/config.php');
				 
				 /** Controllers, libraries and models autoloader via spl_autoload_register **/
				include('autoloader/autoload.php');
				
				/** DB Manager wrapper **/
				include('db/db.class.php');
				
				/** Router library **/
				include('router/Toro.class.php');
				
				/** Template class **/
				include('template/microtemplate.class.php');
				
				/** Cache class **/
				include('cache/cache.class.php');
				
				/** Interfaces and Abstract classes**/
				include('abstract/application.interface.php');
				include('abstract/controller.class.php');
		}
	}