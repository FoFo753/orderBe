<?php declare(strict_types=1);

namespace App\Enums\Food;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TypeFood extends Enum
{
    const  DRINK = 0;
    const FOOD = 1;
    const DESSERT = 2;
}
