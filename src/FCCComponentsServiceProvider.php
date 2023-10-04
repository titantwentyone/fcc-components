<?php

namespace Titantwentyone\FCCComponents;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FCCComponentsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('fcc-components')
            ->hasViews('fcc');
    }
}