# PHP-DB-less 

a light mvc php architecture, to work as a client-server application without using frontend framework



## Authors

- [@AnTh0Ny77](https://github.com/AnTh0Ny77)


## Installation

clone this repo and run 

```bash
  composer install
```
    
## Auth/Examples

One of the main interests is the authentication service in src/services/AuthServices.php
designed to work with bearer type authentication. this uses guzzle for the request 
and returns the content after handling the exceptions. you have to define what you 
will do with the result (ex: build a user using the entities folder)
```php
use Src\Services\AuthService

$security = new AuthService;
$security->login($username, $pass);
```


## Routing and controllers/Examples
first of all you must correctly configure your .htaccess 
file so that all redirections point to the index.php file.
if no math is found when calling the route, the default condition will run,
consider defining a 404 page display controller or a redirect condition.

in other cases you can create your controller, be careful this one must call
classic methods in order not to be instantiated.

Optional : you can extend the BaseController, this allows you to invoke Twig to generate your templates. 
first you will need to call the init(); method. 
```php
use Src\Controllers\IndexController as index;

 case 'URI':
        echo index::index();
        break;

 default:
        header('HTTP/1.0 404 not found');
        echo  index::error404();
        break;
```




## License

[MIT](https://choosealicense.com/licenses/mit/)

