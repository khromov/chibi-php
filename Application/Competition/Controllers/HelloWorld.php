<?php
	namespace Application\Competition\Controllers;
	
	use Chibi\Cache\Cache as Cache;
	
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
			echo "hworld!";
			$myCache = new Cache(array('adapter' => 'apc', 'backup' => 'file'));
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