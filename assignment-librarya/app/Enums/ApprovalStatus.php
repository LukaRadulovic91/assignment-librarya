<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * Class ApprovalStatus
 *
 * @package App\Enums
 */
final class ApprovalStatus extends BaseEnum
{
    const DRAFT = 1;
    const APPROVED = 2;
    const REJECTED = 3;
}
