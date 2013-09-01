<?php
namespace Chibi\Cache;

/**
 * Core cache class. Adapted from CodeIgniter.
*/

class CacheManager extends CacheDriverLibrary
{
	protected $cache_path = null;
	protected $adapter	= 'dummy';
	protected $backup_driver;

	/**
	 * Constructor
	 *
	 * @param array
	 */
	public function __construct($config = array('adapter' => 'APC', 'backup' => null))
	{
		$this->adapter = $config['adapter'];
		$this->backup_driver = $config['backup'];
							//Why do \ work on first two but not last??
		$class_to_load = '\\Chibi\\Cache\\Drivers\\' . $this->adapter;
		$this->adapter_instance = new $class_to_load();

		print_r($this->adapter_instance);
	}

	/**
	 * Get
	 *
	 * Look for a value in the cache.  If it exists, return the data
	 * if not, return FALSE
	 *
	 * @param 	string
	 * @return 	mixed		value that is stored/FALSE on failure
	 */
	public function get($id)
	{
		return $this->{$this->adapter}->get($id);
	}

	/**
	 * Cache Save
	 *
	 * @param 	string		Unique Key
	 * @param 	mixed		Data to store
	 * @param 	int			Length of time (in seconds) to cache the data
	 *
	 * @return 	boolean		true on success/false on failure
	 */
	public function save($id, $data, $ttl = 60)
	{
		return $this->{$this->adapter}->save($id, $data, $ttl);
	}

	/**
	 * Delete from Cache
	 *
	 * @param 	mixed		unique identifier of the item in the cache
	 * @return 	boolean		true on success/false on failure
	 */
	public function delete($id)
	{
		return $this->{$this->adapter}->delete($id);
	}

	/**
	 * Clean the cache
	 *
	 * @return 	boolean		false on failure/true on success
	 */
	public function clean()
	{
		return $this->{$this->adapter}->clean();
	}

	/**
	 * Cache Info
	 *
	 * @param 	string		user/filehits
	 * @return 	mixed		array on success, false on failure
	 */
	public function cache_info($type = 'user')
	{
		return $this->{$this->adapter}->cache_info($type);
	}

	/**
	 * Get Cache Metadata
	 *
	 * @param 	mixed		key to get cache metadata on
	 * @return 	mixed		return value from child method
	 */
	public function get_metadata($id)
	{
		return $this->{$this->adapter}->get_metadata($id);
	}

	/**
	 * Is the requested driver supported in this environment?
	 *
	 * @param 	string	The driver to test.
	 * @return 	array
	 */
	public function is_supported($driver)
	{
		static $support = array();

		if ( ! isset($support[$driver]))
		{
			$support[$driver] = $this->{$driver}->is_supported();
		}

		return $support[$driver];
	}

	/**
	 * __get()
	 *
	 * @param 	child
	 * @return 	object
	 */
	public function __get($child)
	{
		$obj = parent::__get($child);

		if (!$this->is_supported($child))
		{
			$this->_adapter = $this->backup_driver;
		}

		return $obj;
	}
}