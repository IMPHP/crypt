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

/**
 * An implementation of `im\crypt\Crypt`.
 *
 * This is mostly intented as a base class for other crypt
 * classes. However it is made as a full working class by adding
 * a small obfuscating encryption feature that does not rely on any external
 * encryption support. It's a last case meassure and should be avoided when possible.
 *
 *  - First of all it's not very safe. It does provide a small form of security, as
 *    most people do not possess cryptographic knolege to break things like this,
 *    and for those that do, your data may not be worth the trouble. But don't think that
 *    this will make NSA go home crying at knight. Use the OpenSSL crypt class if possible.
 *
 *  - Second, if your data does not have to be absolutly safe, you could have used this for the performance
 *    bennefits compared to a hardcore encryption algo? Again, no. This is actually slower than
 *    encrypting a 256bit AES with OpenSSL.
 */
class ImCrypt implements Crypt {

    /** @internal */
    protected string $mCipherKey;

    /** @internal */
    protected string $mCipherIv;

    /** @internal */
    protected int $mBlockSize = 16;

    /**
     *
     */
    public function __construct() {
        /*
         * These are just default values and should not be used for real deployment.
         * Use 'setCipherIv()' and 'setCipherKey()' to add your own values.
         */
        $this->mCipherIv = pack("H*", Crypt::DEF_IV);
        $this->mCipherKey = pack("H*", Crypt::DEF_KEY);
    }

    /**
     * @internal
     */
    protected function handleCipherKey(?string $key): string {
        if (empty($key)) {
            $key = $this->getCipherKey();

        } else if (ctype_xdigit($key)) {
            $key = pack("H*", $key);
        }

        return $key;
    }

    /**
     * @internal
     */
    protected function handleCipherIv(?string $iv): string {
        if (empty($iv)) {
            $iv = $this->getCipherIv();

        } else if (ctype_xdigit($iv)) {
            $iv = pack("H*", $iv);
        }

        $ivl = $this->getIvLength();
        $ivc = mb_strlen($iv, "8bit");

        if ($ivc > $ivl) {
            $iv = mb_substr($iv, 0, $ivl, "8bit");

        } else if ($ivc < $ivl) {
            /*
             * When the IV is to small, we build on it, to optain the required size.
             * We want this as random as possible, but yet we need to be able to
             * re-create this again.
             */
            for ($y=($ivl - $ivc), $i=$y, $x=1; $x <= $y; $x++) {
                $iv .= chr(
                    ($i = (ord($iv[ $x % $ivc ]) + $i) % 256)
                );
            }
        }

        return $iv;
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Crypt")]
    public function getIvLength(): string {
        return $this->mBlockSize;
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Crypt")]
    public function getKeyLength(): string {
        return $this->mBlockSize * 2;
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Crypt")]
    public function getCipherMode(): string {
        return "cbc";
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Crypt")]
    public function getCipher(): string {
        return "mask";
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Crypt")]
    public function getCipherKey(): string {
        return $this->mCipherKey;
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Crypt")]
    public function setCipherKey(?string $key): void {
        if (empty($key)) {
            $this->mCipherKey = pack("H*", Crypt::DEF_KEY);

        } else {
            if (ctype_xdigit($key)) {
                $key = pack("H*", $key);
            }

            $this->mCipherKey = $key;
        }
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Crypt")]
    public function createCipherIv(): ?string {
        $ivl = $this->getIvLength();

        if ($iv == 0) {
            return null;
        }

        return random_bytes($iv);
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Crypt")]
    public function getCipherIv(): string {
        return $this->mCipherIv;
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Crypt")]
    public function setCipherIv(?string $iv): void {
        if (empty($iv)) {
            $this->mCipherIv = pack("H*", Crypt::DEF_IV);

        } else {
            if (ctype_xdigit($iv)) {
                $iv = pack("H*", $iv);
            }

            $this->mCipherIv = $iv;
        }
    }

    /**
     * An obfuscating method that requires no encryption extension
     *
     * This method will obfuscate data using a key, salt and a CBC block mode method.
     * This is nowhere near a real encryption mecanism, but it is still a lot better than
     * a simple obfuscating method or just plain text. It can be a good addition when your
     * server administrative possibilites are limited and your current installment does not have
     * any real encryption extensions available. The best option however would be to use
     * the `im\crypt\ssl\OpenSSLCrypt` class, if possible.
     *
     * @note
     *      If the data is exstreamly sensitive,
     *      don't use this at all. If someone really want's the data and has the knowhow,
     *      this might annoy them a bit, but it will most likely not stop them.
     */
    #[Override("im\crypt\Crypt")]
    public function encrypt(string $data, string $key=null, string $iv=null): string {
        $key = $this->handleCipherKey($key);
        $iv = $this->handleCipherIv($iv);
        $blockSize = $this->getIvLength();
        $data = $this->pad($data, $blockSize);
        $keySize = mb_strlen($key, "8bit");
        $dataSize = mb_strlen($data, "8bit");
        $readBytes = 0;
        $cipherText = "";

        do {
            $block = $iv ^ mb_substr($data, $readBytes, $blockSize, "8bit");
            $iv = "";

            for ($i=0; $i < $blockSize; ++$i) {
                $iv .= chr((ord($block[$i]) + ord($key[ ($readBytes + $i) % $keySize ])) % 256);
            }

            $cipherText .= $iv;
            $readBytes += $blockSize;

        } while ($readBytes < $dataSize);

        return $cipherText;
    }

    /**
     * @inheritdoc
     */
    #[Override("im\crypt\Crypt")]
    public function decrypt(string $data, string $key=null, string $iv=null): string {
        $key = $this->handleCipherKey($key);
        $iv = $this->handleCipherIv($iv);
        $keySize = mb_strlen($key, "8bit");
        $dataSize = mb_strlen($data, "8bit");
        $blockSize = $this->getIvLength();
        $readBytes = 0;
        $plainText = "";

        do {
            $block = mb_substr($data, $readBytes, $blockSize, "8bit");
            $unmasked = "";

            for ($i=0; $i < $blockSize; ++$i) {
                $char = ord($block[$i]) - ord($key[ ($readBytes + $i) % $keySize ]);
                $unmasked .= $char < 0 ? chr(($char+256)) : chr($char);
            }

            $plainText .= $iv ^ $unmasked;
            $iv = $block;
            $readBytes += $blockSize;

        } while ($readBytes < $dataSize);

        return $this->unpad($plainText);
    }

    /**
     * @internal
     */
    protected function pad(string $data, int $blocksize): string {
        $padSize = $blocksize - (mb_strlen($data, "8bit") % $blocksize);
        $data .= random_bytes( $padSize - 1 );
        $data .= chr($padSize);

        return $data;
    }

    /**
     * @internal
     */
    protected function unpad(string $data): string {
        $dataSize = mb_strlen($data, "8bit");
        $padSize = ord($data[ $dataSize - 1 ]);

        return mb_substr($data, 0, $dataSize - $padSize, "8bit");
    }
}
