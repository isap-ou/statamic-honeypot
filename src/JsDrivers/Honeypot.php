<?php

declare(strict_types=1);

namespace Isapp\Honeypot\JsDrivers;

use Statamic\Forms\Form;
use Statamic\Forms\JsDrivers\Alpine;
use Statamic\Tags\Parameters;

use function app;
use function collect;
use function json_decode;

class Honeypot extends Alpine
{
    protected array $honeypot;

    public function __construct(Form $form, $options = [], ?Parameters $params = null)
    {
        $this->honeypot = app()->make(\Spatie\Honeypot\Honeypot::class)->toArray();

        //        $form->honeypot($this->honeypot);

        parent::__construct($form, $options, $params);
    }

    public function addToFormData($data): array
    {
        $data['honeypotData'] = [...$this->honeypot, 'scope' => $this->scope];

        return $data;
    }

    public function addToFormAttributes()
    {
        $extraData = $this->params->pull('x-data', []);

        if (\is_string($extraData)) {
            $extraData = json_decode($extraData);
        }

        if ($this->honeypot['enabled']) {
            $extraData[$this->honeypot['nameFieldName']] = '';
            $extraData[$this->honeypot['validFromFieldName']] = $this->honeypot['encryptedValidFrom'];
        }

        return [
            'x-data' => $this->renderAlpineXData(
                collect($this->getInitialFormData())->merge($extraData)->all(),
                $this->scope
            ),
        ];
    }
}
