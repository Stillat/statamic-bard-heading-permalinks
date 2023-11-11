<?php

namespace Stillat\StatamicBardHeadingPermalinks;

use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/bard_permalinks.php', 'bard_permalinks');

        $this->publishes([
            __DIR__.'/../config/bard_permalinks.php' => config_path('bard_permalinks.php'),
        ], 'bard-permalinks-config');
    }
}
