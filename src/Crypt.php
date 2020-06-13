<?php

namespace Pendragon\Framework;

class Crypt
{
    public static function keyGenerate(): string
    {
        return random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
        // return md5(uniqid(rand(), true));
    }

    public static function encrypt(string $data, string $key): string
    {
        if (mb_strlen($key, '8bit') !== SODIUM_CRYPTO_SECRETBOX_KEYBYTES) {
            throw new \RangeException('Key is not the correct size (must be 32 bytes).');
        }

        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

        $cipher = base64_encode(
            $nonce . sodium_crypto_secretbox(
                $data,
                $nonce,
                $key
            )
        );
        sodium_memzero($data);
        sodium_memzero($key);

        return $cipher;
    }

    public static function decrypt(string $encrypted, string $key): string
    {
        $decoded = base64_decode($encrypted);
        $nonce = mb_substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
        $ciphertext = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');

        $plain = sodium_crypto_secretbox_open(
            $ciphertext,
            $nonce,
            $key
        );

        if (!is_string($plain)) {
            throw new \Exception('Invalid MAC');
        }

        sodium_memzero($ciphertext);
        sodium_memzero($key);

        return $plain;
    }
}