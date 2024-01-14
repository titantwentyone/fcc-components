<?php

namespace Titantwentyone\FCCComponents;

use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Titantwentyone\FCCComponents\Components\Columns;

class FCCComponentsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('fcc-components')
            ->hasViews('fccc')
            ->hasViewComponent('columns', \Titantwentyone\FCCComponents\View\Components\Content\Columns::class);
    }

    public function bootingPackage()
    {
        \Titantwentyone\FilamentContentComponents\ComponentRegister::registerComponents([
            Columns::class
        ]);
    }
}