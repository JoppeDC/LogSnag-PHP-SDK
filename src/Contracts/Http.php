<?php

declare(strict_types=1);

namespace JoppeDc\LogsnagPhpSdk\Contracts;

interface Http
{
    public function post(string $path, $body = null);

    public function patch(string $path, $body = null);
}
