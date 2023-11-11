<?php

uses(Tests\TestCase::class)->in('Feature');

use Statamic\Fields\Field;
use Statamic\Fieldtypes\Bard;

function bard($config = [])
{
    return (new Bard)->setField(new Field('test', array_merge(['type' => 'bard', 'sets' => []], $config)));
}
