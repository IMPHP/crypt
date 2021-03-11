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
 * Defines a hash class that contains different hash tools
 * using a pre-defined hash algo. The class may even work with
 * a shared secret and salt value, further simplifying the usage when sharing
 * the instance across a project.
 */
interface Hash {

    /** Default Salt value */
    const /*string*/ DEF_SALT = "d4a2c36e56a462d8a4f3f54a22af6e6b18c45988326b46285e499ffe786a24ee";

    /** Default Secret */
    const /*string*/ DEF_SECRET = "2c61e30a13a33fc271f6f925e4d44d54";

    /**
     * Get the current shared secret
     */
    function getSecret(): string;

    /**
     * Set a new shared secret
     */
    function setSecret(string $secret): void;

    /**
     * Get the current shared salt value
     */
    function getSalt(): string;

    /**
     * Create a random salt value that best fits the
     * type of algo used.
     */
    function createSalt(): string;

    /**
     * Set a new shared salt value
     */
    function setSalt(string $salt): void;

    /**
     * Get the name of the current algo used by this class
     */
    function getAlgo(): string;

    /**
     * Create a cryptographic hash value
     *
     * @param int $size
     *      Size of the output value
     *
     * @param string $secret
     *      Secret/Password that will be used to create the hash value.
     *      If no secret/password is specified, the shared secret will be used.
     *
     * @param string $salt
     *      Salt value that will be used when creating the hash value.
     *      You can use `createSalt()` to create a proper salt value.
     *      If no salt value is specified, the shared salt value will be used.
     *
     * @return
     *      The hash value in binary format
     */
    function createKdf2(int $size, string $secret=null, string $salt=null): string;

    /**
     * Generate a hash value from data using a keyed hash
     *
     * @param string $data
     *      Data to hash
     *
     * @param string $secret
     *      Secret/Password that will be used to create the keyed hash.
     *
     * @return
     *      The hash value in binary format
     */
    function hash_hmac(string $data, string $secret=null): string;

    /**
     * Generate a hash value from data
     *
     * @param string $data
     *      Data to hash
     *
     * @return
     *      The hash value in binary format
     */
    function hash(string $data): string;

    /**
     * Compare two hash values
     *
     * This method is a timing attack safe comparison method.
     * In any case where you need to compare two hash values that
     * is connected to user input, you should use this method rather than
     * doing a simple `hash1 == hash2`. For internal comparison it has no impact.
     *
     * @param string $hash1
     *      Hash to compare against
     *
     * @param string $hash2
     *      Hash to compare
     */
    function compareHash(string $hash1, string $hash2): bool;

    /**
     * Converts a hex string into a binary string
     */
    function hex2raw(string $data): string;

    /**
     * Converts a binary string into a hex string
     */
    function raw2hex(string $data): string;

    /**
     * Encode a string to base64 in http safe format
     */
    function encode_b64(string $data): string;

    /**
     * Decode a base64 string to it's original state
     */
    function decode_b64(string $data): string;

    /**
     * Create a signature from specified data
     *
     * @param string $data
     *      Data to create a signature from
     *
     * @param string $secret
     *      Secret/Password to used for the signature
     *      If no secret/password is specified, the shared secret will be used.
     *
     * @return
     *      The signature
     */
    function sign(string $data, string $secret=null): string;

    /**
     * Verify a signature
     *
     * @param string $data
     *      The data to check
     *
     * @param string $signature
     *      The signature to verify
     *
     * @param string $secret
     *      Secret/Password that was used to create the signature
     *      If no secret/password is specified, the shared secret will be used.
     */
    function verify(string $data, string $signature, string $secret=null): bool;

    /**
     * This method will obfuscate data using a Secret/Password
     *
     * @param string $data
     *      Data to obfuscate
     *
     * @param
     *      Secret/Password that will be used to obfuscate the data
     *      If no secret/password is specified, the shared secret will be used.
     */
    function mask(string $data, string $secret=null): string;

    /**
     * Restores previously obfuscated data to it's original state
     *
     * @param string $data
     *      The obfuscated data to restore
     *
     * @param string $secret
     *      Secret/Password that was used to obfuscate the data
     *      If no secret/password is specified, the shared secret will be used.
     */
    function unmask(string $data, string $secret=null): string;
}
