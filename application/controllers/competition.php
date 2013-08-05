<?php
	class Competition extends Controller
	{
	    function get($slug)
	    {
	    	$db_record_id = base_convert($slug, 36, 10);
	        echo "Competition id: {$db_record_id}";
	    }
	}