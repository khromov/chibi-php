<?php
	namespace Chibi\Router;
	
	class Toro
	{
		public function __construct()
		{
		}
		
	    public static function serve($routes, $route_prefix = '', $application_namespace) //TODO: Should default value be set?
	    {
	        ToroHook::fire('before_request');
			
	        //If route prefix is set
	        if($route_prefix !== '')
	        {
	            //Apply route prefix for every route
	            foreach($routes as $route => $handler)
	            {
	                $routes[$route_prefix . $route] = $handler;
	                unset($routes[$route]);
	            }
	         }
	
	        $request_method = strtolower($_SERVER['REQUEST_METHOD']);
	        $path_info = '/';
			
	        if (!empty($_SERVER['PATH_INFO']))
	        {
	            $path_info = $_SERVER['PATH_INFO'];
	        }
	        else if (!empty($_SERVER['ORIG_PATH_INFO']) && $_SERVER['ORIG_PATH_INFO'] !== '/index.php')
	        {
	            $path_info = $_SERVER['ORIG_PATH_INFO'];
	        }
	        else
	        {
	            if (!empty($_SERVER['REQUEST_URI']))
	            {
	                $path_info = (strpos($_SERVER['REQUEST_URI'], '?') > 0) ? strstr($_SERVER['REQUEST_URI'], '?', true) : $_SERVER['REQUEST_URI'];
	            }
	        }
	        
	        $discovered_handler = null;
	        $regex_matches = array();
	
	        if (isset($routes[$path_info]))
	        {
	            $discovered_handler = $routes[$path_info];
	        }
	        else if ($routes)
	        {
	        	//TODO: Add customizable replacement tokens
	            $tokens = array(
	                ':string' => '([a-zA-Z]+)',
	                ':number' => '([0-9]+)',
	                ':alpha'  => '([a-zA-Z0-9-_]+)'
	            );
	            foreach ($routes as $pattern => $handler_name)
	            {
	                $pattern = strtr($pattern, $tokens);
	                if(preg_match('#^/?' . $pattern . '/?$#', $path_info, $matches))
	                {
	                    $discovered_handler = $handler_name;
	                    $regex_matches = $matches;
	                    break;
	                }
	            }
	        }
			
			//Here we need to check against a proper namespace.
			$assembled = $application_namespace . '\\Controllers\\' . $discovered_handler;
			//var_dump(class_exists($assembled));
			
	        if ($discovered_handler && class_exists($assembled))
	        {
	            unset($regex_matches[0]);
				
				//Init new controller class
	            $handler_instance = new $assembled();
	
	            if (self::is_xhr_request() && method_exists($discovered_handler, $request_method . '_xhr'))
	            {
	                header('Content-type: application/json');
	                header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	                header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
	                header('Cache-Control: no-store, no-cache, must-revalidate');
	                header('Cache-Control: post-check=0, pre-check=0', false);
	                header('Pragma: no-cache');
	                $request_method .= '_xhr';
	            }
	
	            if (method_exists($handler_instance, $request_method))
	            {
	                ToroHook::fire('before_handler');
	                call_user_func_array(array($handler_instance, $request_method), $regex_matches);
	                ToroHook::fire('after_handler');
	            }
	            else
	            {
	                ToroHook::fire('404');
	            }
	        }
	        else
	        {
	            ToroHook::fire('404');
	        }
	
	        ToroHook::fire('after_request');
	    }
	
	    private static function is_xhr_request()
	    {
	        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
	    }
	}