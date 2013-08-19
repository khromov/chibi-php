<?php
	/** Perform autoloading **/
	//spl_autoload_register(null, false);
	//spl_autoload_extensions('.php,.class.php,.lib.php');

	//http://stackoverflow.com/a/3710672
	set_include_path(implode(PATH_SEPARATOR, array(get_include_path(), './application/controllers', './application/libraries', './application/models')));
	spl_autoload_register();
	//spl_autoload_register(function($in){ autoload stuff here });