# W.A.S.A.B.I
Web Application Solution for Accurate Battlegroup Intelligence
This package is a self-deployable and customizable application for Laravel 5.X that provide routes, controllers, models and migrations for a powerfull team management solution.


## Installation
1.In the root of your installed laravel
```php
composer require ekushisu/wasabi
```

2.Add the provider
```php
Ekushisu\Wasabi\WasabiProvider::class,
```

3.Then publish wasabi content
```php
php artisan vendor:publish --provider="Ekushisu\Wasabi\WasabiProvider" --force
```
You can add this different tags:
* "views"
* "config"
* "lang"
* "assets"
```php
--tag="tag"
```
In your env file, or directly in the wasabi config file edit the WASABI domain.
WASABI is using sub-domain routing, so please, give to WASABI the url, as exemple:
```txt
WASABI_DOMAIN=wasabi.zombo.com
```
If empty the default url will be 'localhost'

4.Build Assets
**NodeJS and Grunt-CLI are required for the following steps**
* Go to resources/assets/wasabi folder.
* Type:
```javascript
npm install
```
* then type the first line or the second if you are respectively on development ENV or production ENV
```javascript
grunt dev
grunt prod
```
