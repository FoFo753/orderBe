<?php

declare(strict_types=1);

namespace App\Enums\Food;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusFood extends Enum
{
    const AVAILABLE = 1;
    const UNAVAILABLE = 0;
}
