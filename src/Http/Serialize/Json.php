<?php

declare(strict_types=1);

namespace JoppeDc\LogsnagPhpSdk\Http\Serialize;

use JoppeDc\LogsnagPhpSdk\Exceptions\JsonDecodingException;
use JoppeDc\LogsnagPhpSdk\Exceptions\JsonEncodingException;

class Json implements SerializerInterface
{
    private const JSON_ENCODE_ERROR_MESSAGE = 'Encoding data to json failed: "%s".';
    private const JSON_DECODE_ERROR_MESSAGE = 'Decoding data to json failed: "%s".';

    /**
     * {@inheritDoc}
     */
    public function serialize($data)
    {
        try {
            $encoded = json_encode($data, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new JsonEncodingException(sprintf(self::JSON_ENCODE_ERROR_MESSAGE, $e->getMessage()), $e->getCode(), $e);
        }

        return $encoded;
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize(string $string)
    {
        try {
            $decoded = json_decode($string, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new JsonDecodingException(sprintf(self::JSON_DECODE_ERROR_MESSAGE, $e->getMessage()), $e->getCode(), $e);
        }

        return $decoded;
    }
}
