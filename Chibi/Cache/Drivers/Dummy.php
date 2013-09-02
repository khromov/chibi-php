<?php
namespace Chibi\Cache\Drivers;

/**
 * Dummy caching class. Doesn't cache anything and always returns false to get requests.
 *
 * Class APC
 * @package Chibi\Cache\Drivers
 */
class Dummy extends AbstractDriverExtended
{
	/**
	 * Dummy function.
	 *
	 * @param $key
	 * @return bool
	 */
	public function get($key)
	{
		return false;
	}

	/**
	 * Dummy function.
	 *
	 * @param $key
	 * @param $value
	 * @param int $ttl
	 * @return bool
	 */
	public function set($key, $value, $ttl = 0)
	{
		return true;
	}

	/**
	 * Dummy function.
	 *
	 * @param $key
	 * @param $value
	 * @param int $ttl
	 *
	 * @return mixed
	 */
	public function setAndReturn($key, $value, $ttl = 0)
	{
		return $key;
	}

	/**
	 * Dummy function.
	 *
	 * @param $key
	 * @param $value
	 * @param $ttl
	 * @return bool
	 */
	public function setIfNotExists($key, $value, $ttl)
	{
		return true;
	}

	/**
	 * Dummy function.
	 *
	 * @param $key
	 * @return bool|\string[]
	 */
	public function delete($key)
	{
		return true;
	}

	/**
	 * Dummy function.
	 *
	 * @return bool
	 */
	public function clear()
	{
		return true;
	}

	/**
	 * Dummy function.
	 *
	 * @param $key
	 * @return bool|\string[]
	 */
	public function exists($key)
	{
		return false;
	}

	/**
	 * Dummy function.
	 *
	 * @param string $type
	 * @return array|bool
	 */
	public function cacheInfo($type = 'user')
	{
		return false;
	}

	/**
	 * Dummy function.
	 *
	 * @param 	mixed		key to get cache metadata on
	 * @return 	mixed		array on success/false on failure
	 */
	public function getMetadata($key)
	{
		return false;
	}

	/**
	 * Dummy function.
	 *
	 * @return boolean	always returns true
	 */
	public function isSupported()
	{
		return true;
	}
}