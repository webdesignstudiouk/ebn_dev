<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CurrentUserServiceProvider extends ServiceProvider
{
    public function register()
    {
      $this->app->bind(User::class, function ($app) {
      return Auth::user();
    });
    }
}
