<?php 
namespace Greenball\Hashing;

use Illuminate\Support\ServiceProvider;

class HashServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// Preload the config.
		$this->app['config']->package('greenball/hashing', realpath(__DIR__.'/../../config'));

		// Replace the hash with our native hasher.
		$this->app['hash'] = $this->app->share(function($app) {
			return new NativeHasher($app);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('hash');
	}

}