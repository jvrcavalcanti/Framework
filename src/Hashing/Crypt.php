<?php

namespace Pendragon\Framework\Hashing;

class Crypt
{
    private string $method;
    private string $iv;
    private string $firstKey;
    private string $secondKey;
    private $tag;

    public function __construct(string $firstKey, string $method = "aes-256-cbc")
    {
        $this->firstKey = base64_decode($firstKey);
        $this->secondKey = openssl_random_pseudo_bytes(64);

        $this->method = $method;
        $ivlen = openssl_cipher_iv_length($this->method);
        $this->iv = openssl_random_pseudo_bytes($ivlen);
    }

    public function encrypt(string $data)
    {
        $firstEncrypted = openssl_encrypt(
            $data,
            $this->method,
            $this->firstKey,
            OPENSSL_RAW_DATA,
            $this->iv
        );

        $secondEncrypted = hash_hmac(
            'sha3-512',
            $firstEncrypted,
            $this->secondKey,
            true
        );

        return base64_encode($this->iv . $secondEncrypted . $firstEncrypted);
    }

    public function decrypt(string $encrypted)
    {
        $mix = base64_decode($encrypted);

        $iv_length = openssl_cipher_iv_length($this->method);
        $iv = substr($mix, 0, $iv_length);

        $secondEncrypted = substr($mix, $iv_length, 64);
        $firstEncrypted = substr($mix, $iv_length + 64);

        $data = openssl_decrypt(
            $firstEncrypted,
            $this->method,
            $this->firstKey,
            OPENSSL_RAW_DATA,
            $iv
        );

        $secondEncryptedNew = hash_hmac('sha3-512', $firstEncrypted, $this->secondKey, true);

        return $data;
    }
}
