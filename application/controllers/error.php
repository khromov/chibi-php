<?php
	class Error extends Controller //Extends ToroController
	{
	    function get($response_code)
	    {
	    	http_response_code::set(404);
			
			if($response_code == 404)
				echo "{$response_code} Page not found"; //$this->template->('error', 404); <-- fetched from ToroController
			else
	    		echo "{$response_code} Error";
	    }
	}