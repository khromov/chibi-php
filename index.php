<?php
	/**
	* Main file
	*/
	require('config.inc.php');
	
	/** Composer autoloader DISABLED FOR NOW WHILE Toro gets a revamp **/
	//require('vendor/autoload.php');
	require('core/micro.php');
	
	/** This is our application **/
	require('application/bootstrap.php');
	
	/** Standard pattern for running the application **/
	$app = new App_Competition($config);
	$app->run();