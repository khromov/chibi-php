<?php
	/**
	* Config for database
	*/
	$config['db']['connection_string'] = 'mysql:host=localhost;dbname=competition;charset=utf8';
	$config['db']['username'] = 'chibi-php';
	$config['db']['password'] = '';	 
	 
	/** Unique secret key for various uses **/
	$config['site']['secret_key'] = 'secret';
	 
	/** Site URL prefix. Used for routing. **/
	$config['site']['site_prefix'] = '/chibi-php';