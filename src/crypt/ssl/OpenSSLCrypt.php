<?php
/*
 * This file is part of the IMPHP Project: https://github.com/IMPHP
 *
 * Copyright (c) 2020 Daniel Bergløv, License: MIT
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO
 * THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR
 * THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace im\crypt\ssl;

use im\exc\CryptException;
use im\crypt\ImCrypt;

/**
 * An implementation of `im\crypt\Crypt` using OpenSSL.
 */
class OpenSSLCrypt extends ImCrypt {

    /** @internal */
    protected string $mCipher;

    /** @internal */
    protected string $mMode;

    /** @internal */
    protected string $mCipherMode;

    /** @internal */
    protected int $mKeySize = 0;

    /** @internal */
    protected int $mIvSize = 0;

    /**
     * @param string $cipher
     *      The cipher to use.
     *
     *      This must be compatible with the PHP OpenSSL extension.
     *      It defaults to `aes-256-cbc`.
     */
    public function __construct(string $cipher=null) {
        parent::__construct();

        if (!function_exists("openssl_encrypt")) {
            throw new CryptException("OpenSSL extension is missing from this installment");
        }

        if (empty($cipher)) {
            $cipher = "aes-256-cbc";

        } else {
            $cipher = strtolower($cipher);
        }

        /*
         * The array from openssl_get_cipher_methods() mixes
         * upper and lower case.
         */
        $methods = openssl_get_cipher_methods();
        array_walk($methods, function(&$value){
            $value = strtolower($value);
        });

        if (!in_array($cipher, $methods)) {
            throw new CryptException("Unsupported cipher '$cipher'");
        }

        /*
         * Extract the cipher information
         */
        if (preg_match("/^(?:.*-)?(?:(cast[0-9]*|chacha[0-9]*|rc[0-9]*|sm[0-9]*|aes|aria|bf|des[x]?|seed|[a-z]+)-?([0-9]*))-(cbc|ccm|cfb|ctr|ecb|gcm|ocb|ofb|xts|ofb|wrap)(?:[0-9]*)/", $cipher, $matches)) {
            $this->mCipher = $matches[1]."-".$matches[2];
            $this->mMode = $matches[3];
            $this->mKeySize = $matches[2] / 8;

        } else if (preg_match("/^(.*)-(cbc|ccm|cfb|ctr|ecb|gcm|ocb|ofb|xts|ofb|wrap)(?:[0-9]*)/", $cipher, $matches)) {
            $this->mCipher = $matches[1];
            $this->mMode = $matches[2];

        } else if (preg_match("/^(.*)-([a-z0-9]+)$/", $cipher, $matches)) {
            $this->mCipher = $matches[1];
            $this->mMode = $matches[2];

        } else {
            $this->mCipher = $cipher;
            $this->mMode = "unknown";
        }

        $this->mCipherMode = $cipher;
        $this->mIvSize = (int) openssl_cipher_iv_length($cipher);

        if ($this->mKeySize == 0) {
            $this->mKeySize = $this->mIvSize == 0 ? 16 : $this->mIvSize * 2;
        }
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\ImCrypt")]
    public function getCipherMode(): string {
        return $this->mMode;
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\ImCrypt")]
    public function getCipher(): string {
        return $this->mCipher;
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\ImCrypt")]
    public function getIvLength(): string {
        return $this->mIvSize;
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\ImCrypt")]
    public function getKeyLength(): string {
        return $this->mKeySize;
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\ImCrypt")]
    public function createCipherIv(): ?string {
        $ivl = $this->getIvLength();

        if ($iv == 0) {
            return null;
        }

        $iv = openssl_random_pseudo_bytes($ivl, $strong );

        if (!$strong) {
            $iv = random_bytes($ivl);
        }

        return $iv;
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\ImCrypt")]
    public function encrypt(string $data, string $key=null, string $iv=null): string {
        // Clear error messages
        while(openssl_error_string() !== false);

        $key = $this->handleCipherKey($key);
        $iv = $this->handleCipherIv($iv);

        $cipherText = openssl_encrypt($data, $this->mCipherMode, $key, OPENSSL_RAW_DATA, $iv);

        if ($cipherText === false) {
            throw new CryptException(openssl_error_string());
        }

        return $cipherText;
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\ImCrypt")]
    public function decrypt(string $data, string $key=null, string $iv=null): string {
        // Clear error messages
        while(openssl_error_string() !== false);

        $key = $this->handleCipherKey($key);
        $iv = $this->handleCipherIv($iv);

        $plainText = openssl_decrypt($data, $this->mCipherMode, $key, OPENSSL_RAW_DATA, $iv);

        if ($plainText === false) {
            throw new CryptException(openssl_error_string());
        }

        return $plainText;
    }
}
