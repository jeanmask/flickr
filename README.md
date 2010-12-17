Flickr API Module for Kohana 3.0.x
===================================

## How to use:
### Configuration
	1.  Copy _config/flickr.php_ to application's config folder
	2.  Set your _API-Key_ and _Secret_ ( [more info](http://www.flickr.com/services/api/keys/) )
	3.  Set cache lifetime in seconds or `false` to disable


### Use
	Instantiate the Class and execute query method. ex: `echo Kohana::debug( Flickr::instance()->query('flickr.test.echo') );`


### Dependencies
	[Cache Module](http://github.com/kohana/cache) is required to caching requests.


### Obs
	All received data use [php_serial](http://www.flickr.com/services/api/response.php.html) after is converted to Array.

Sugestions? jean@webmais.net.br

[]'s :)
