<?php
namespace Chibi\Cache\Drivers;

/**
 * Class AbstractDriverSimple
 * @package Chibi\Cache\Drivers
 *
 * The bare minimum that a cache adapter needs to support.
 */
abstract class AbstractDriverSimple
{
	/* Getters, setters */

	/**
	 * Gets a value from the cache by key.
	 *
	 * @param $key
	 * @return boolean True if successful, false otherwise.
	 */
	abstract protected function get($key);

	/**
	 * Sets the value of a key.
	 *
	 * @param $key
	 * @param $value
	 * @param $ttl
	 * @return boolean True if successful, false otherwise.
	 */
	abstract protected function set($key, $value, $ttl);

	/**
	 * Deletes a key
	 *
	 * @param $key
	 * @return boolean True if successful, false otherwise.
	 */
	abstract protected function delete($key);

	/**
	 * Checks if a key exists in the cache.
	 *
	 * @param $key
	 * @return boolean True if successful, false otherwise.
	 */
	abstract protected function exists($key);

	/**
	 * Clears the entire  user cache store.
	 * Use delete() to delete single keys.
	 *
	 * @return boolean True if successful, false otherwise.
	 */
	abstract protected function clear();

	/* Misc. functions */

	/**
	 * Checks if the cache adapter is supported by the current PHP environment.
	 *
	 * @return boolean True if the adapter is supported, false otherwise.
	 */
	abstract protected function isSupported();
}