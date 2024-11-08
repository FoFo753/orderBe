<?php

namespace App\Enums\Category;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusCategory extends Enum
{
    const OPEN = 1;
    const CLOSE = 0;
}
