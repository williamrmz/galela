<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('whereLike', function(string $attribute, string $searchTerm)
        {
            return $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
        });

        Builder::macro('whereTrim', function(string $attribute, string $value)
        {
            return $this->whereRaw("LTRIM(RTRIM($attribute)) = LTRIM(RTRIM($value))");
        });
    }
}
