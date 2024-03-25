<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * Class PublicationStatus
 *
 * @package App\Enums
 */
final class PublicationStatus extends BaseEnum
{
    const DRAFT = 1;
    const PENDING_REVIEW = 2;
    const PUBLISHED = 3;
    const REJECTED = 4;
}
