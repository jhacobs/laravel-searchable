<?php

namespace Jhacobs\Searchable;

use Illuminate\Support\ServiceProvider;

class SearchableServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        WhereLike::register();
    }
}
