<?php

declare(strict_types=1);

namespace JoppeDc\LogsnagPhpSdk\Http\Serialize;

use JoppeDc\LogsnagPhpSdk\Exceptions\JsonDecodingException;
use JoppeDc\LogsnagPhpSdk\Exceptions\JsonEncodingException;

interface SerializerInterface
{
    /**
     * @param string|int|float|bool|array|null $data
     *
     * @return string|bool
     *
     * @throws JsonEncodingException
     */
    public function serialize($data);

    /**
     * @return string|int|float|bool|array|null
     *
     * @throws JsonDecodingException
     */
    public function unserialize(string $string);
}
