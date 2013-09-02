<?php
namespace Chibi\Cache\Drivers;

/**
 * Extends the AbstractDriverSimple controller to provide some additional nice-to-have functions.
 *
 * Class AbstractDriverExtended
 * @package Chibi\Cache\Drivers
 *
 */
abstract class AbstractDriverExtended extends AbstractDriverSimple
{
	/**
	 * Sets a key => value in and also returns the value so you can echo it easily.
	 * By using this function you will not get the return value back from the cache adapter
	 * as you would with set()
	 *
	 * @param $key
	 * @param $value
	 * @param $ttl
	 * @return mixed
	 */
	abstract protected function setAndReturn($key, $value, $ttl);

	/**
	 * Sets a key => value if it does not already exist. If the key exists, no changes are made.
	 *
	 * @param $key
	 * @param $value
	 * @param $ttl
	 * @return mixed
	 */
	abstract protected function setIfNotExists($key, $value, $ttl);

	/* Extra info functions */

	/**
	 * Returns array of stats and key metadata or FALSE on failure.
	 * Array keys and data depend on the implementation of the driver.
	 *
	 * @return mixed
	 */
	abstract protected function cacheInfo();

	/**
	 * Get metadata for a key, such as the TTL value and the number of hits.
	 * Returns an array. Array keys depend on the implementation of the driver.
	 *
	 * @param $key
	 * @return mixed
	 */
	abstract protected function getMetadata($key);
}