<?php

declare(strict_types=1);

namespace App\Enums\Sale;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class SaleStatus extends Enum
{
    const UNAVAILABLE = 0;
    const AVAILABLE = 1;
}
