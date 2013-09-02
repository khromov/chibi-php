<?php
namespace Application\Competition\Controllers;

class HelloWorld
{

	/** before_handler and after_handler are defined within handler's constructor: **/
	function __construct()
	{
		//parent::__construct();
		/*
		ToroHook::add("before_handler", function() { echo "Before"; });
		ToroHook::add("after_handler", function() { echo "After"; });
		*/
	}

	function get()
	{
		global $app;

		//$rand = rand(0,100);

		//echo "Last rand was: {$app->cache->get('test')}<br/>";

		//echo "Inserting: {$rand} <br/>";

		$app->cache->set('test', 'kebab', 0);
		$app->cache->set('test2', 'kebab2', 0);
		$app->cache->set('test3', 'kebab3', 0);

		/** Standard way to do cache
		if(!$app->cache->exists('test12345'))
		{
			//Get from "db".
			$slowdata = 'qwerty';

			//Set data in cache
			$app->cache->set('test12345', $slowdata, 5);

			//Echo data
			echo $slowdata . ' from db';
		}
		else
			echo $app->cache->get('test12345');
		*/
		/** Faster way  **/
		if(!$app->cache->exists('test12345'))
		{
			$slowdata = 'qwerty';
			$app->cache->setIfNotExists('test12345', $slowdata, 0) . ' from db';
			echo $slowdata;
		}
		else
			echo $app->cache->get('test12345');

		$key_info = $app->cache->getMetadata('test12345');
		print_r($key_info);
	}

	/*
	function get()
	{
		echo json_encode($this->app->config);

		//print_r(get_included_files());
		$myCache = new Cache(array('adapter' => 'apc', 'backup' => 'file'));

		if (!$myCache->get('foo'))
		{
			 echo 'Saving to the cache!<br />';
			 $foo = 'foobarbaz!';

			 // Save into the cache for 5 minutes
			 $myCache->save('foo', $foo, 300);
		}
		else
			echo $myCache->get('foo');

		$id = 1;

		//Run queries etc
		try
		{
			$statement = $this->app->db->prepare("SELECT * FROM competitions WHERE competition_id=:id");
			$statement->bindParam(':id', $id, PDO::PARAM_INT);
			$statement->execute();

			$ret = $statement->fetchAll(PDO::FETCH_ASSOC);
			//print_r($ret);
		}
		catch(PDOException $ex)
		{
			echo $ex;
		}
	}
	 * /
	 */
}