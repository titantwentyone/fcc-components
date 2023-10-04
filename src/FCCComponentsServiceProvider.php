<?php

namespace Titantwentyone\FCCComponents;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Titantwentyone\FCCComponents\Components\Columns;

class FCCComponentsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('fcc-components')
            ->hasViews('fcc');
    }

    public function bootingPackage()
    {
        \Titantwentyone\FilamentContentComponents\ComponentRegister::registerComponents([
            Columns::class
        ]);
    }
}