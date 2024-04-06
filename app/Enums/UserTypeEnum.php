<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserTypeEnum extends Enum
{
    const ADMINISTRATOR = 1;
    const HEALTHCARE_PROVIDER = 2;
    
    // parent is the target user
    const PARENT = 3;
}
