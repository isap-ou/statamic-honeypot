<?php

declare(strict_types=1);

namespace Isapp\Honeypot;

use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $viewNamespace = 'isapp';

    protected $tags = [
        Tags\Honeypot::class,
    ];

    protected $middlewareGroups = [
        'web' => [\Spatie\Honeypot\ProtectAgainstSpam::class],
    ];

    protected $formJsDrivers = [
        JsDrivers\Honeypot::class,
    ];

    public function bootAddon()
    {
        //
    }
}
