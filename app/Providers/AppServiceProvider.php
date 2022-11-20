<?php

namespace App\Providers;

use App\Actions\RoleListAction;
use App\Contracts\RoleListActionInterface;
use Illuminate\Http\Resources\Json\JsonResource;
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
        $this->app->bind(RoleListActionInterface::class, RoleListAction::class);
        JsonResource::withoutWrapping();
    }
}
