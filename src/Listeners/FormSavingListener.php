<?php

declare(strict_types=1);

namespace Isapp\Honeypot\Listeners;

use Illuminate\Support\Facades\Config;
use Statamic\Events\FormSaving;

class FormSavingListener
{
    /**
     * Handle the event.
     */
    public function handle(FormSaving $event): void
    {
        /** @var \Statamic\Forms\Form $form */
        $form = $event->form;

        if ($form->data('honeypot') === Config::get('honeypot.valid_from_field_name')) {
            return;
        }

        $form->honeypot(Config::get('honeypot.valid_from_field_name'));
    }
}
