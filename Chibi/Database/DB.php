<?php
	namespace Chibi\Database;
	
	use PDO;
	
	/**
	 * PDO Wrapper. Connects only when required.
	 * 
	 * http://stackoverflow.com/a/5484811
	 */
	class DB extends PDO
	{
		protected $_config = array();
		var $_connected = false;

		public function __construct($dsn, $user = null, $pass = null, $options = null)
		{
			/** Save connection details for later **/
			$this->_config = array(
				'dsn' => $dsn,
				'user' => $user,
				'pass' => $pass,
				'options' => $options
			);
		}

		public function checkConnection()
		{
			if (!$this->_connected) 
			{
				extract($this->_config);
				parent::__construct($dsn, $user, $pass, $options);
				$this->_connected = true;
			}
		}
		
		public function prepare($statement, $driver_options = array())
		{
			$this->checkConnection();
			return parent::prepare($statement, $driver_options);
		}

		public function query($query)
		{
			$this->checkConnection();
			return parent::query($query);
		}

		public function exec($query)
		{
			$this->checkConnection();
			return parent::exec($query);
		}
	}