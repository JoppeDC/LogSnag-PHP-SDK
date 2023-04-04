<?php

declare(strict_types=1);

namespace JoppeDc\LogsnagPhpSdk;

class Logsnag
{
    public const VERSION = '1.0.0';

    public static function qualifiedVersion()
    {
        return sprintf('LogSnag PHP (v%s)', self::VERSION);
    }
}
