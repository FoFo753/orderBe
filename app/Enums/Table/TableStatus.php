<?php

declare(strict_types=1);

namespace App\Enums\Table;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TableStatus extends Enum
{
    const OCCUPIED = 0;
    const UNOCCUPIED = 1;
    const FIXING = 2;
}
