# [Crypt](crypt.md) / ImHash
 > im\crypt\ImHash
____

## Description
An implementation of `im\crypt\Hash`.

## Synopsis
```php
class ImHash implements im\crypt\Hash {

    // Inherited Constants
    public DEF_SALT = 'd4a2c36e56a462d8a4f3f54a22af6e6b18c45988326b46285e499ffe786a24ee'
    public DEF_SECRET = '2c61e30a13a33fc271f6f925e4d44d54'

    // Methods
    public __construct(null|string $algo = NULL)
    public getSecret(): string
    public setSecret(string $secret): void
    public getSalt(): string
    public createSalt(): string
    public setSalt(string $salt): void
    public getAlgo(): string
    public getAlgoLength(): int
    public createKdf2(int $size, null|string $secret = NULL, null|string $salt = NULL): string
    public hash_hmac(string $data, null|string $secret = NULL): string
    public hash(string $data): string
    public compareHash(string $hash1, string $hash2): bool
    public hex2raw(string $data): string
    public raw2hex(string $data): string
    public encode_b64(string $data): string
    public decode_b64(string $data): string
    public sign(string $data, null|string $secret = NULL): string
    public verify(string $data, string $signature, null|string $secret = NULL): bool
    public mask(string $data, null|string $secret = NULL): string
    public unmask(string $data, null|string $secret = NULL): string
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__ImHash&nbsp;::&nbsp;DEF\_SALT__](crypt-ImHash-prop_DEF_SALT.md) | Default Salt value |
| [__ImHash&nbsp;::&nbsp;DEF\_SECRET__](crypt-ImHash-prop_DEF_SECRET.md) | Default Secret |

## Methods
| Name | Description |
| :--- | :---------- |
| [__ImHash&nbsp;::&nbsp;\_\_construct__](crypt-ImHash-__construct.md) |  |
| [__ImHash&nbsp;::&nbsp;getSecret__](crypt-ImHash-getSecret.md) |  |
| [__ImHash&nbsp;::&nbsp;setSecret__](crypt-ImHash-setSecret.md) |  |
| [__ImHash&nbsp;::&nbsp;getSalt__](crypt-ImHash-getSalt.md) |  |
| [__ImHash&nbsp;::&nbsp;createSalt__](crypt-ImHash-createSalt.md) |  |
| [__ImHash&nbsp;::&nbsp;setSalt__](crypt-ImHash-setSalt.md) |  |
| [__ImHash&nbsp;::&nbsp;getAlgo__](crypt-ImHash-getAlgo.md) |  |
| [__ImHash&nbsp;::&nbsp;getAlgoLength__](crypt-ImHash-getAlgoLength.md) |  |
| [__ImHash&nbsp;::&nbsp;createKdf2__](crypt-ImHash-createKdf2.md) |  |
| [__ImHash&nbsp;::&nbsp;hash\_hmac__](crypt-ImHash-hash_hmac.md) |  |
| [__ImHash&nbsp;::&nbsp;hash__](crypt-ImHash-hash.md) |  |
| [__ImHash&nbsp;::&nbsp;compareHash__](crypt-ImHash-compareHash.md) |  |
| [__ImHash&nbsp;::&nbsp;hex2raw__](crypt-ImHash-hex2raw.md) |  |
| [__ImHash&nbsp;::&nbsp;raw2hex__](crypt-ImHash-raw2hex.md) |  |
| [__ImHash&nbsp;::&nbsp;encode\_b64__](crypt-ImHash-encode_b64.md) |  |
| [__ImHash&nbsp;::&nbsp;decode\_b64__](crypt-ImHash-decode_b64.md) |  |
| [__ImHash&nbsp;::&nbsp;sign__](crypt-ImHash-sign.md) |  |
| [__ImHash&nbsp;::&nbsp;verify__](crypt-ImHash-verify.md) |  |
| [__ImHash&nbsp;::&nbsp;mask__](crypt-ImHash-mask.md) |  |
| [__ImHash&nbsp;::&nbsp;unmask__](crypt-ImHash-unmask.md) |  |
