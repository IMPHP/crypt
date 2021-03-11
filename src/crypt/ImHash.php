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

namespace im\crypt;

use im\exc\CryptException;

/**
 * An implementation of `im\crypt\Hash`.
 */
class ImHash implements Hash {

    /** @ignore */
    protected string $mSecret;

    /** @ignore */
    protected string $mSalt;

    /** @ignore */
    protected string $mAlgo;

    /** @ignore */
    protected string $mAlgoLength;

    /**
     * @param $algo
     *      The hash algo to use
     */
    public function __construct(string $algo=null) {
        $algos = hash_algos();

        if ($algo != null) {
            if (!in_array($algo, $algos)) {
                throw new CryptException("Could not find support for hash algo '$algo'");
            }

            $this->mAlgo = strtolower($algo);

        } else {
            $prefered = ["sha256", "sha3-256", "sha1", "md5", "whirlpool"];

            foreach ($prefered as $algo) {
                if (in_array($algo, $algos)) {
                    $this->mAlgo = $algo; break;
                }
            }

            /*
             * Should not be possible. At least sha1 and md5 should have support, but better to be safe...
             */
            if (empty($this->mAlgo)) {
                throw new CryptException("Could not find a supported hash algo");
            }
        }

        /*
         * These are just default values and should not be used for real deployment.
         * Use 'setSalt()' and 'setSecret()' to add your own values.
         */
        $this->mSalt = pack("H*", Hash::DEF_SALT);
        $this->mSecret = pack("H*", Hash::DEF_SECRET);
        $this->mAlgoLength = mb_strlen(hash($this->mAlgo, $this->mSalt, true), "8bit");
    }

    /**
     * @internal
     */
    protected function handleSecret(?string $secret): string {
        if (empty($secret)) {
            $secret = $this->getSecret();

        } else if (ctype_xdigit($secret)) {
            $secret = $this->hex2raw($secret);
        }

        return $secret;
    }

    /**
     * @internal
     */
    protected function handleSalt(?string $salt): string {
        if (empty($salt)) {
            $salt = $this->getSalt();

        } else if (ctype_xdigit($salt)) {
            $salt = $this->hex2raw($salt);
        }

        return $salt;
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Hash")]
    public function getSecret(): string {
        return $this->mSecret;
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Hash")]
    public function setSecret(string $secret): void {
        $this->mSecret = $this->handleSecret($secret);
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Hash")]
    public function getSalt(): string {
        return $this->mSalt;
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Hash")]
    public function createSalt(): string {
        return random_bytes( $this->getAlgoLength() );
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Hash")]
    public function setSalt(string $salt): void {
        $this->mSalt = $this->handleSalt($salt);
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Hash")]
    public function getAlgo(): string {
        return $this->mAlgo;
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Hash")]
    public function getAlgoLength(): int {
        return $this->mAlgoLength;
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Hash")]
    public function createKdf2(int $size, string $secret=null, string $salt=null): string {
        $secret = $this->handleSecret($secret);
        $salt = $this->handleSalt($salt);

        /* Do a small randomizing on the iteration count
         */
        $itt = ord($salt[0]);
        while (($itt = (int) ($itt/2)) > 10) {}
        $itt = $itt > 0 ? $itt*496 : 4096;

        return hash_pbkdf2($this->getAlgo(), $secret, $salt, $itt, $size, true);
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Hash")]
    public function hash_hmac(string $data, string $secret=null): string {
        return hash_hmac($this->getAlgo(), $data, $this->handleSecret($secret), true);
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Hash")]
    public function hash(string $data): string {
        return hash($this->getAlgo(), $data, true);
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Hash")]
    public function compareHash(string $hash1, string $hash2): bool {
        return hash_equals($hash1, $hash2);
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Hash")]
    public function hex2raw(string $data): string {
        return pack("H*", $data);
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Hash")]
    public function raw2hex(string $data): string {
        return unpack("H*", $data)[1];
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Hash")]
    public function encode_b64(string $data): string {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Hash")]
    public function decode_b64(string $data): string {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Hash")]
    public function sign(string $data, string $secret=null): string {
        return $this->hash_hmac($data, $this->handleSecret($secret));
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Hash")]
    public function verify(string $data, string $signature, string $secret=null): bool {
        return $this->compareHash($this->hash_hmac($data, $this->handleSecret($secret)), $signature);
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Hash")]
    public function mask(string $data, string $secret=null): string {
        $secret = $this->handleSecret($secret);
        $dataLength = mb_strlen($data, "8bit");
        $keyLength = mb_strlen($secret, "8bit");
        $masked = "";

        for ($i=0; $i < $dataLength; ++$i) {
            $masked .= chr((ord($data[$i]) + ord($secret[ $i % $keyLength ])) % 256);
        }

        return $masked;
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Hash")]
    public function unmask(string $data, string $secret=null): string {
        $secret = $this->handleSecret($secret);
        $dataLength = mb_strlen($data, "8bit");
        $keyLength = mb_strlen($secret, "8bit");
        $unmasked = "";

        for ($i=0; $i < $dataLength; ++$i) {
            $char = ord($data[$i]) - ord($secret[ $i % $keyLength ]);
            $unmasked .= $char < 0 ? chr(($char+256)) : chr($char);
        }

        return $unmasked;
    }
}
