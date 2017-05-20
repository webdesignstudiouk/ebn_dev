Laravel Whoops
==============

A [Whoops](https://github.com/filp/whoops) exception handler for Laravel >= 5.1. When the `app.debug` configuration is set to `true`, this package will overwrite the default exception handler class in Laravel and show a nice Whoops error page instead of the default one when an exception is thrown.
The `WhoopsExceptionHandler` class extends from `\App\Exceptions\Handler` and only overwrites the `convertExceptionToResponse` method, so all modifications made in the default handler will stay in effect.

Installation
------------

Installation using composer:

```
composer require cheatcodes/laravel-whoops
```

And add the service provider in `config/app.php`:

```php
'providers' => [
    // ...
    CheatCodes\LaravelWhoops\WhoopsServiceProvider::class,
    // ...
],
```

That's it.