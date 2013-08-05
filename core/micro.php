<?php
	/**
	 * Load our required classes
	 */
	 
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