<?php
namespace Greenball\Hashing;

use Illuminate\Foundation\Application;
use Illuminate\Hashing\HasherInterface;

class NativeHasher implements HasherInterface {

	/**
	 * Algorithm used for hashing.
	 *
	 * @see http://www.php.net/manual/en/function.hash.php
	 * @var string
	 */
	protected $algorithm;

	/**
	 * Random string length attached to every hash.
	 *
	 * @var integer
	 */
	protected $random;

	/**
	 * Application's salt.
	 *
	 * @var mixed
	 */
	protected $salt;

	/**
	 * Initialize the app.
	 *
	 * @param  \Illuminate\Foundation\Application $app
	 * @return void
	 */
	public function __construct(Application $app)
	{
		$this->algorithm 	= $app['config']->get('hashing::algorithm');
		$this->random 		= $app['config']->get('hashing::random');
		$this->salt 		= $app['config']->get('app.salt');
	}

	/**
	 * Hash the given value.
	 *
	 * @param  string  $value
	 * @param  array   $options
	 * @return string
	 */
	public function make($value, array $options = array()) {
		// Generate random salt to make every result different.
		$random 	= strtolower(str_random($this->random));

		return hash($this->algorithm, $value.$this->salt.$random).$random;
	}

	/**
	 * Check the given plain value against a hash.
	 *
	 * @param  string  $value
	 * @param  string  $hashedValue
	 * @param  array   $options
	 * @return bool
	 */
	public function check($value, $hashedValue, array $options = array()) {
		// Cut the random value for rehashing.
		$random 	= substr($hashedValue, -$this->random);

		return ($hashedValue == hash($this->algorithm, $value.$this->salt.$random).$random);
	}

	/**
	 * Check if the given hash has been hashed using the given options.
	 *
	 * @param  string  $hashedValue
	 * @param  array   $options
	 * @return bool
	 */
	public function needsRehash($hashedValue, array $options = array()) {
		return false;
	}

}
