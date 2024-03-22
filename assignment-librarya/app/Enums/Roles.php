<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Roles extends Enum
{
    const AUTHOR = 1;
    const REVIEWER = 2;

    public function toArray()
    {
        // TODO: Implement toArray() method.
    }

    public static function castUsing(array $arguments)
    {
        // TODO: Implement castUsing() method.
    }

    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }
}
