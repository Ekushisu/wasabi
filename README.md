# W.A.S.A.B.I
Web Application Solution for Accurate Battlegroup Intelligence
This package is a self-deployable and customizable application for Laravel 5.X that provide routes, controllers, models and migrations for a powerfull team management solution.


## Installation
In the root of your installed laravel

```php
composer require ekushisu/wasabi
```
Then publish wasabi content
```php
php artisan vendor:publish --provider="Ekushisu\Wasabi\WasabiProvider" --force
```
You can add this different tags:
* "views"
* "config"
* "lang"
```php
--tag="tag"
```
In your env file, or directly in the wasabi config file edit the WASABI domain.
WASABI is using sub-domain routing, so please, give to WASABI the url, as exemple:
```txt
WASABI_DOMAIN=wasabi.zombo.com
```
If empty the default url will be http://localhost
