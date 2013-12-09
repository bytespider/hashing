<?php
return array(
	/**
	 * Algorithm used at hashing.
	 * To see which algorithms your server support use the hash_algos() function.
	 * @see http://php.net/manual/en/function.hash-algos.php
	 *
	 * @var string
	 */
	'algorithm'	=> 'md5',

	/**
	 * At every hashing the script adds a random string to the hash
	 * to make every result different you can define here
	 * the length of that random string.
	 *
	 * @var integer
	 */
	'random'	 => 16,
);