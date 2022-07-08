<?php

namespace Respins\BaseFunctions;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Respins\BaseFunctions\Commands\BaseFunctionsCommand;
use Respins\BaseFunctions\ProxyHelper;

class BaseFunctionsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {   
        //Register package functions
        $package
            ->name('base-functions')
            ->hasConfigFile()
            ->hasViews('respins-base-views')
            ->hasRoutes(['base', 'game'])
            ->hasMigration('create_gamesessions_table')
            ->hasCommand(BaseFunctionsCommand::class);

            //Register the proxy
            $this->app->bind('ProxyHelper', function($app) {
                return new ProxyHelper();
            });
            
    }
}

