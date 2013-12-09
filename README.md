## Greenball Hashing

This small package drops the Laravel 4 framework's BCrypt requirement. Also has some additional features.

### Features
+ Config file oriented.
+ Can change the hashing algorithm.
+ Alters the native PHP hash function to generate different values at each hashing.
### Installation
Add the following to your composer.
```json
"require": {
	"greenball/hashing": "dev-master"
}
```
After the ***composer update*** replace the ServiceProvider in your app.php
```php
'providers' => array(
	// Other providers...
	#'Illuminate\Hashing\HashServiceProvider',
    'Greenball\Hashing\HashServiceProvider',
),
```
*Note: You can simply rewrite the Illuminate to Greenball in the providers.*
### Supported algorithms
The package uses the PHP [hash()](http://www.php.net/manual/en/function.hash.php) function, to determine which algorithms your server supports simply run this.
```php
var_dump(hash_algos());
```

### Publish configuration
You can publish the package config if you wish to change the default setting.
```
php artisan config:publish greenball/hashing
```
After this you can find the config file
***@app/config/packages/greenball/hashing/config.php***

#### Configuration: algorithm
Choose the used hashing algorithm, you can see the supported algorithms section above.
#### Configuration: random
This option sets how long random string will be attached to the hash.

### Altered hashing logic
As mentioned above the hashing mechanism a bit altered. At every hashing the script will generate a random string and gona trail your hash with it; With this even if you hash the same string with e.g.: sha1 algorithm the result always gona be different.
```php
$base 	= 'Greenball';
$hashed = Hash::make($base);
$rehash = Hash::make($base);
$wrong 	= Hash::make('Hashing');

echo 'Hash::check: '. (Hash::check($base, $hashed) ? 'Passed' : 'Failed') . '<br>';
echo 'Hash::check wrong: '. (Hash::check($wrong, $hashed) ? 'Failed' : 'Passed') . '<br>';
echo 'Hash: ' . $hashed . '<br>';
echo 'Rehash: ' . $rehash . '<br>';
```

### Origin
I used [robclancy/laravel4-hashing](https://github.com/robclancy/laravel4-hashing) as base idea, big thanks to him too. That packages works perfectly too but for me the required package which makes the hash is too heavy for a simple thing like hashing. This is why I wrote this, hope gona be useful to you too ;)

### Testing

-- Will be added soon --