<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class VaccinesEnum extends Enum
{
    const BCG = 1;
    const HEPATITIS_B = 2;
    const PENTAVALENT = 5;
    const OPV = 8;
    const IPV = 9;
    const PCV = 12;
    const MMR = 14;
}
