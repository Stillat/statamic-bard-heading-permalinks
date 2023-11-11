<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Statamic\Extend\Manifest;
use Stillat\StatamicBardHeadingPermalinks\ServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app->make(Manifest::class)->manifest = [
            'stillat/statamic-bard-heading-permalinks' => [
                'id' => 'stillat/statamic-bard-heading-permalinks',
                'namespace' => 'Stillat\\StatamicBardHeadingPermalinks',
            ],
        ];
    }

    protected function getPackageProviders($app)
    {
        return [
            \Statamic\Providers\StatamicServiceProvider::class,
            \Rebing\GraphQL\GraphQLServiceProvider::class,
            \Wilderborn\Partyline\ServiceProvider::class,
            \Archetype\ServiceProvider::class,
            ServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Statamic' => 'Statamic\Statamic',
        ];
    }
}
