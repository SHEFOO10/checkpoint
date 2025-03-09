<?php

namespace AskerAkbar\Checkpoint;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Illuminate\Filesystem\Filesystem;

class CheckpointServiceProvider extends PackageServiceProvider
{
    public static string $name = 'checkpoint';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasMigration('2024_10_03_140231_create_checkpoint_settings')
            ->hasTranslations()
            ->hasViews()
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->askToRunMigrations()
                    ->publishMigrations()
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub('shefoo10/checkpoint')
                    ->endWith(function (InstallCommand $command) {
                        $command->info('Have a great day!');
                    });
            });
    }

    public function packageBooted(): void
    {
    }
}
