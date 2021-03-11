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
 * Defines a crypt class that can be used to encrypt/decrypt data
 * using a pre-defined cipher. The class may even work with
 * a shared key and iv value.
 */
interface Crypt {

    /** Default IV value */
    const /*string*/ DEF_IV = "8882e0f16f5815ea522d4771fae58161365603984768c7cd746ac2dc99a4dc25";

    /** Default Key */
    const /*string*/ DEF_KEY = "db067721fd2d08f329b4e27e71656c0470da6fae483b47f1114b17ec8ef1239d6f509ef536e149f5a4c2af45edbf49c7f2cabec24de1a74121b3a6534c9572e0";

    /**
     * Get the length of the IV that is best suided for this cipher.
     *
     * Note that any IV that is smaller than this recommented size,
     * will get auto generated data added to it. This data can be
     * replicated each time, allowing the same IV to work.
     *
     * Any IV that is larger than this recommented size,
     * will be truncated.
     *
     * The best option is to add a valid sized IV, but the second option
     * would be to add a larger IV that can be truncated instead, as it would
     * likely make for a stronger IV than building on one that is to small.
     *
     * You can use `createCipherIv()` to create a valid IV,
     * that is best fitted the current cipher.
     */
    function getIvLength(): string;

    /**
     * Get the size best suided for the key that is to be used with the current cipher.
     *
     * It is best to use an encryption key that is at least
     * as long as this recommented size. Larger keys will not
     * make things more secure, but it will not hurt either.
     */
    function getKeyLength(): string;

    /**
     * Get the name of the cipher mode used by the current cipher.
     */
    function getCipherMode(): string;

    /**
     * Get the name of the cipher currently used by this instance.
     */
    function getCipher(): string;

    /**
     * Get the current shared cipher/encryption key.
     *
     * You can set a new key using `setCipherKey()`.
     */
    function getCipherKey(): string;

    /**
     * Set a new shared cipher/encryption key .
     *
     * By default the script uses a default shared key, this key should not
     * be used in production, so it's best to set a new key,
     * if you plan on using a shared key with this instance.
     *
     * @param string $key
     *      The new cipher/encryption key
     */
    function setCipherKey(?string $key): void;

    /**
     * Create a cipher iv that matches the requirements of the cipher
     *
     * @return
     *      This method will return `null` if the cipher does not require an iv
     */
    function createCipherIv(): ?string;

    /**
     * Get the current shared iv that is being used
     */
    function getCipherIv(): string;

    /**
     * Set a new shared cipher iv
     *
     * @param string $iv
     *      The new cipher iv to use
     */
    function setCipherIv(?string $iv): void;

    /**
     * Encrypts data using the specified cipher in this instance
     *
     * @param string $data
     *      The data to encrypt
     *
     * @param string $key
     *      The cipher/encryption key to use for the encryption
     *      If no cipher/encryption key is specified, the shared key will be used.
     *
     * @param string $iv
     *      The IV to use with the encryption
     *      If no IV is specified, the shared IV will be used.
     */
    function encrypt(string $data, string $key=null, string $iv=null): string;

    /**
     * Decrypts data using the specified cipher in this instance
     *
     * @param string $data
     *      The data to decrypt
     *
     * @param string $key
     *      The cipher/encryption key that was used to encrypt the data
     *      If no cipher/encryption key is specified, the shared key will be used.
     *
     * @param string $iv
     *      The IV that was used to encrypt the data
     *      If no IV is specified, the shared IV will be used.
     */
    function decrypt(string $data, string $key=null, string $iv=null): string;
}
