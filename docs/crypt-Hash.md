# [Crypt](crypt.md) / Hash
 > im\crypt\Hash
____

## Description
Defines a hash class that contains different hash tools
using a pre-defined hash algo. The class may even work with
a shared secret and salt value, further simplifying the usage when sharing
the instance across a project.

## Synopsis
```php
interface Hash {

    // Constants
    DEF_SALT = 'd4a2c36e56a462d8a4f3f54a22af6e6b18c45988326b46285e499ffe786a24ee'
    DEF_SECRET = '2c61e30a13a33fc271f6f925e4d44d54'

    // Methods
    getSecret(): string
    setSecret(string $secret): void
    getSalt(): string
    createSalt(): string
    setSalt(string $salt): void
    getAlgo(): string
    createKdf2(int $size, string $secret = NULL, string $salt = NULL): string
    hash_hmac(string $data, string $secret = NULL): string
    hash(string $data): string
    compareHash(string $hash1, string $hash2): bool
    hex2raw(string $data): string
    raw2hex(string $data): string
    encode_b64(string $data): string
    decode_b64(string $data): string
    sign(string $data, string $secret = NULL): string
    verify(string $data, string $signature, string $secret = NULL): bool
    mask(string $data, null|string $secret = NULL): string
    unmask(string $data, string $secret = NULL): string
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__Hash&nbsp;::&nbsp;DEF\_SALT__](crypt-Hash-prop_DEF_SALT.md) | Default Salt value |
| [__Hash&nbsp;::&nbsp;DEF\_SECRET__](crypt-Hash-prop_DEF_SECRET.md) | Default Secret |

## Methods
| Name | Description |
| :--- | :---------- |
| [__Hash&nbsp;::&nbsp;getSecret__](crypt-Hash-getSecret.md) | Get the current shared secret |
| [__Hash&nbsp;::&nbsp;setSecret__](crypt-Hash-setSecret.md) | Set a new shared secret |
| [__Hash&nbsp;::&nbsp;getSalt__](crypt-Hash-getSalt.md) | Get the current shared salt value |
| [__Hash&nbsp;::&nbsp;createSalt__](crypt-Hash-createSalt.md) | Create a random salt value that best fits the type of algo used |
| [__Hash&nbsp;::&nbsp;setSalt__](crypt-Hash-setSalt.md) | Set a new shared salt value |
| [__Hash&nbsp;::&nbsp;getAlgo__](crypt-Hash-getAlgo.md) | Get the name of the current algo used by this class |
| [__Hash&nbsp;::&nbsp;createKdf2__](crypt-Hash-createKdf2.md) | Create a cryptographic hash value |
| [__Hash&nbsp;::&nbsp;hash\_hmac__](crypt-Hash-hash_hmac.md) | Generate a hash value from data using a keyed hash |
| [__Hash&nbsp;::&nbsp;hash__](crypt-Hash-hash.md) | Generate a hash value from data |
| [__Hash&nbsp;::&nbsp;compareHash__](crypt-Hash-compareHash.md) | Compare two hash values  This method is a timing attack safe comparison method |
| [__Hash&nbsp;::&nbsp;hex2raw__](crypt-Hash-hex2raw.md) | Converts a hex string into a binary string |
| [__Hash&nbsp;::&nbsp;raw2hex__](crypt-Hash-raw2hex.md) | Converts a binary string into a hex string |
| [__Hash&nbsp;::&nbsp;encode\_b64__](crypt-Hash-encode_b64.md) | Encode a string to base64 in http safe format |
| [__Hash&nbsp;::&nbsp;decode\_b64__](crypt-Hash-decode_b64.md) | Decode a base64 string to it's original state |
| [__Hash&nbsp;::&nbsp;sign__](crypt-Hash-sign.md) | Create a signature from specified data |
| [__Hash&nbsp;::&nbsp;verify__](crypt-Hash-verify.md) | Verify a signature |
| [__Hash&nbsp;::&nbsp;mask__](crypt-Hash-mask.md) | This method will obfuscate data using a Secret/Password |
| [__Hash&nbsp;::&nbsp;unmask__](crypt-Hash-unmask.md) | Restores previously obfuscated data to it's original state |
