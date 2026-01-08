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
        if (! empty($this->context->get('spatieHoneypot'))) {
            $data = $this->context->get('spatieHoneypot');
            if (! empty($this->params->get('is-precognition'))) {
                $data['scope'] = 'form';
            }
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
