<?php
namespace CheatCodes\LaravelWhoops;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;

class WhoopsServiceProvider extends ServiceProvider
{
	/**
	 * Overwrite the default ExceptionHandler
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton(ExceptionHandler::class, WhoopsExceptionHandler::class);
	}
}
