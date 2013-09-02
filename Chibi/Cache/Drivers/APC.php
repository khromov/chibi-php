<?php
namespace Chibi\Cache\Drivers;

/**
 * Adds support for APC cache.
 *
 * Class APC
 * @package Chibi\Cache\Drivers
 */
class APC extends AbstractDriverExtended
{
	/**
	 * Gets a value from the cache by key.
	 *
	 * @param $key
	 * @return mixed
	 */
	public function get($key)
	{
		return apc_fetch($key);
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
		return apc_store($key, $value, $ttl);
	}

	/**
	 * Sets a key => value in APC and also returns the value so you can echo it easily.
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
	 * @return bool True if something was added to the cache, false otherwise
	 */
	public function setIfNotExists($key, $value, $ttl)
	{
		return apc_add($key, $value, $ttl);
	}

	/**
	 * Deletes a key
	 *
	 * @param $key
	 * @return bool|\string[]
	 */
	public function delete($key)
	{
		return apc_delete($key);
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