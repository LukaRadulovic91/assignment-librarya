<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PublicationStatus extends Enum
{
    const DRAFT = 1;
    const PENDING_REVIEW = 2;
    const PUBLISHED = 3;
    const REJECTED = 4;

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
