<?php
namespace Chibi\Cache\Drivers;

/**
 * In-memory cache. The lifespan of this cache is for the request only.
 *
 * Class APC
 * @package Chibi\Cache\Drivers
 */
class Memory extends AbstractDriverExtended
{
	private $cache = array();

	/**
	 * Gets a value from the cache by key.
	 *
	 * @param $key
	 * @return mixed
	 */
	public function get($key)
	{
		if(array_key_exists($key, $this->cache))
			return $this->cache[$key]['value'];
		else
			return false;
	}

	/**
	 * Sets the value of a key.
	 *
	 * @param $key
	 * @param $value
	 * @param int $ttl
	 * @return array|bool
	 */
	public function set($key, $value, $ttl = 0)
	{
		$this->cache[$key] = array(
			'value' => $value,
			'ttl' => $ttl,
			'creation_time' => time()
		);

		return true;
	}

	/**
	 * Sets a key => value in and also returns the value so you can echo it easily.
	 * By using this function you will not get the return value back from the cache adapter
	 * as you would with set()
	 *
	 * @param $key
	 * @param $value
	 * @param int $ttl
	 */
	public function setAndReturn($key, $value, $ttl = 0)
	{
		$this->set($key, $value, $ttl);
		return $value;
	}

	/**
	 * Sets a key => value if it does not already exist. If the key exists, no changes are made.
	 *
	 * @param $key
	 * @param $value
	 * @param $ttl
	 * @return bool
	 */
	public function setIfNotExists($key, $value, $ttl)
	{
		if(array_key_exists($key, $this->cache))
			return false;
		else
		{
			$this->set($key, $value, $ttl);
			return true;
		}

	}

	/**
	 * Deletes a key
	 *
	 * @param $key
	 * @return bool|\string[]
	 */
	public function delete($key)
	{
		if(array_key_exists($key, $this->cache))
		{
			unset($this->cache[$key]);
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Clears the entire  user cache store.
	 * Use delete() to delete single keys.
	 *
	 * @return bool
	 */
	public function clear()
	{
		return apc_clear_cache('user');
	}

	/**
	 * Returns true if variable exists.
	 * Or if an array was passed to $key, then an array is returned that
	 * contains all existing keys, or an empty array if none exist.
	 *
	 * @param $key
	 * @return bool|\string[]
	 */
	public function exists($key)
	{
		return apc_exists($key);
	}

	/**
	 * Returns array of stats and key metadata or FALSE on failure.
	 *
	 * @param string $type
	 * @return array|bool
	 */
	public function cacheInfo($type = 'user')
	{
		return apc_cache_info($type);
	}

	/**
	 * Get metadata for a key, such as the TTL value and the number of hits.
	 *
	 * @param 	mixed		key to get cache metadata on
	 * @return 	mixed		array on success/false on failure
	 */
	public function getMetadata($key)
	{
		$info = apc_cache_info('user');

		foreach($info['cache_list'] as $cache_item)
		{
			if($cache_item['info'] == $key)
				return $cache_item;
		}

		return false;
	}

	/**
	 * is_supported()
	 *
	 * Check to see if APC is available on this system, bail if it isn't.
	 */
	public function isSupported()
	{
		if (!extension_loaded('apc') OR ini_get('apc.enabled') != "1")
			return false;
		else
			return true;
	}
}