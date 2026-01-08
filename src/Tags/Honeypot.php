<?php

declare(strict_types=1);

namespace Isapp\Honeypot\Tags;

use Spatie\Honeypot\View\HoneypotComponent;
use Statamic\Tags\Tags;

use function app;
use function view;

class Honeypot extends Tags
{
    protected static $handle = 'isapp';

    /**
     * The {{ honeypot }} tag.
     *
     * @throws \Throwable
     */
    public function honeypot(): array|string
    {
        if (! empty($this->context->get('honeypotData'))) {
            $data = $this->context->get('honeypotData');
            if ($this->context->get('js_driver') === 'honeypot') {
                return view('isapp::alpine.honeypot', $data)->render();
            }

            return view('honeypot::honeypotFormFields', $data);
        }

        return app()->make('blade.compiler')
            ->renderComponent(
                new HoneypotComponent(app()->make(\Spatie\Honeypot\Honeypot::class))
            );
    }
}
