<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ApprovalStatus extends Enum
{
    const DRAFT = 1;
    const APPROVED = 2;
    const REJECTED = 3;

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
