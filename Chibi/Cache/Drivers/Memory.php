<?php
namespace Chibi\Cache\Drivers;

/**
 * In-memory cache. The lifespan of this cache is for the request only.
 *
 * Class Memory
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
		//FIXME: Maybe this is a better option
		//http://stackoverflow.com/questions/3716649/how-to-auto-call-function-in-php-for-every-other-function-call
		$this->expireKeyIfNeeded($key);

		//Key exists in cache
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
		$this->expireKeyIfNeeded($key);

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
			return false;
	}

	/**
	 * Clears the entire  user cache store.
	 * Use delete() to delete single keys.
	 *
	 * @return bool
	 */
	public function clear()
	{
		$this->cache = array();
		return true;
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
		//Expires the key if needed, before checking whether it exists.
		$this->expireKeyIfNeeded($key);
		return array_key_exists($key, $this->cache);
	}

	/**
	 * Returns array of stats and key metadata or FALSE on failure.
	 *
	 * @param string $type
	 * @return array|bool
	 */
	public function cacheInfo($type = 'user')
	{
		return false;
	}

	/**
	 * Get metadata for a key, such as the TTL value and the number of hits.
	 *
	 * @param 	mixed		key to get cache metadata on
	 * @return 	mixed		array on success/false on failure
	 */
	public function getMetadata($key)
	{
		if(array_key_exists($key, $this->cache))
		{
			return array(
				'ttl' => $this->cache[$key]['ttl'],
				'creation_time' => $this->cache[$key]['creation_time']
			);
		}
		else
			return false;
	}

	/**
	 * In-memory cache is always supported.
	 *
	 * @return 	bool	returns true
	 */
	public function isSupported()
	{
		return true;
	}

	/** Private helpers */

	/**
	 * Expires a key if needed by unsetting it.
	 *
	 * @param $key
	 * @return bool true if the key was expired, false if the key should not expire yet or if it does not exist.
	 */
	private function expireKeyIfNeeded($key)
	{
		//Key exists in cache
		if(array_key_exists($key, $this->cache))
		{
			//If cache can expire at all. 0 = infinite cache
			if($this->cache[$key]['ttl'] != 0)
			{
				//If the expiration time has expired
				if(time() >= $this->cache[$key]['creation_time']+$this->cache[$key]['ttl'])
				{
					//Unset the key
					unset($this->cache[$key]);

					//Return false
					return true;
				}
				else
					return false;
			}
			else
				return false;
		}
		else
			return false;
	}
}
