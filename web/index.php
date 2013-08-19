<?php
	/**
	* Main file for Chibi
	*/
	//namespace Application\Competition;
	//namespace Chibi;
	/** Include autoloader **/
	//include('Chibi/Core/Autoloader/SplClassLoader.php');
	//require_once(__DIR__.'/../Chibi/Core/Autoloader/SplClassLoader.php');
	
	/**
*     // Example which loads classes for the Doctrine Common package in the
 *     // Doctrine\Common namespace.
 *     $classLoader = new SplClassLoader('Doctrine\Common', '/path/to/doctrine');
 *     $classLoader->register();
 *	 
	 */
	//namespace Chibi; //SplClassLoader('Chibi', __DIR__.'/..');
	
	include('SplClassLoader.php');
	
	$chibiLoader = new SplClassLoader('Chibi', __DIR__.'/..');
	$chibiLoader->register();	
	
	$applicationLoader = new SplClassLoader('Application', __DIR__.'/..');
	$applicationLoader->register();
	
	//Chibi needs to load here...?
	
	$app = new Application\Competition\Competition();
	$app->run();
	
	/** \Chibi\Core\Chibi => /path/to/project/lib/vendor/Chibi/Core/Chibi.php **/
	//$chibi = new Chibi\Chibi();
	
	//namespace Application\Competition;
	//use Application\Competition\App as App;
	
	/** Set namespace **/
	
	//include('Chibi/Core/Chibi.php');
	
	//require('core/Chibi.php');
	
	/** Composer autoloader DISABLED FOR NOW WHILE Toro gets a revamp **/
	//require('vendor/autoload.php');
	
	/** This is our application **/
	//require('application/bootstrap.php');
	
	/** Standard pattern for running the application **/

	
	// -----------------------------------------------------
	
	//$app = new Application\Competition\Competition($config);
	//$app->run();