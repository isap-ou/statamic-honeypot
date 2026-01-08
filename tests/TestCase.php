<?php

declare(strict_types=1);

namespace Isapp\StatamicHoneypot\Tests;

use Isapp\StatamicHoneypot\ServiceProvider;
use Statamic\Testing\AddonTestCase;

abstract class TestCase extends AddonTestCase
{
    protected string $addonServiceProvider = ServiceProvider::class;
}
