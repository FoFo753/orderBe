<?php declare(strict_types=1);

namespace App\Enums\User;

use BenSampo\Enum\Enum;

final class UserRole extends Enum
{
    const STAFF = 0;
    const MANAGER = 1;
}
