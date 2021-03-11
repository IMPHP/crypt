# [Crypt](crypt.md) / OpenSSLCrypt
 > im\crypt\ssl\OpenSSLCrypt
____

## Description
An implementation of `im\crypt\Crypt` using OpenSSL.

## Synopsis
```php
class OpenSSLCrypt extends im\crypt\ImCrypt implements im\crypt\Crypt {

    // Inherited Constants
    public DEF_IV = '8882e0f16f5815ea522d4771fae58161365603984768c7cd746ac2dc99a4dc25'
    public DEF_KEY = 'db067721fd2d08f329b4e27e71656c0470da6fae483b47f1114b17ec8ef1239d6f509ef536e149f5a4c2af45edbf49c7f2cabec24de1a74121b3a6534c9572e0'

    // Methods
    public __construct(string $cipher = NULL)
    public getCipherMode(): string
    public getCipher(): string
    public getIvLength(): string
    public getKeyLength(): string
    public createCipherIv(): null|string
    public encrypt(string $data, null|string $key = NULL, null|string $iv = NULL): string
    public decrypt(string $data, null|string $key = NULL, null|string $iv = NULL): string

    // Inherited Methods
    public getCipherKey(): string
    public setCipherKey(null|string $key): void
    public getCipherIv(): string
    public setCipherIv(null|string $iv): void
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__OpenSSLCrypt&nbsp;::&nbsp;DEF\_IV__](crypt-OpenSSLCrypt-prop_DEF_IV.md) | Default IV value |
| [__OpenSSLCrypt&nbsp;::&nbsp;DEF\_KEY__](crypt-OpenSSLCrypt-prop_DEF_KEY.md) | Default Key |

## Methods
| Name | Description |
| :--- | :---------- |
| [__OpenSSLCrypt&nbsp;::&nbsp;\_\_construct__](crypt-OpenSSLCrypt-__construct.md) |  |
| [__OpenSSLCrypt&nbsp;::&nbsp;getCipherMode__](crypt-OpenSSLCrypt-getCipherMode.md) |  |
| [__OpenSSLCrypt&nbsp;::&nbsp;getCipher__](crypt-OpenSSLCrypt-getCipher.md) |  |
| [__OpenSSLCrypt&nbsp;::&nbsp;getIvLength__](crypt-OpenSSLCrypt-getIvLength.md) |  |
| [__OpenSSLCrypt&nbsp;::&nbsp;getKeyLength__](crypt-OpenSSLCrypt-getKeyLength.md) |  |
| [__OpenSSLCrypt&nbsp;::&nbsp;createCipherIv__](crypt-OpenSSLCrypt-createCipherIv.md) |  |
| [__OpenSSLCrypt&nbsp;::&nbsp;encrypt__](crypt-OpenSSLCrypt-encrypt.md) |  |
| [__OpenSSLCrypt&nbsp;::&nbsp;decrypt__](crypt-OpenSSLCrypt-decrypt.md) |  |
| [__OpenSSLCrypt&nbsp;::&nbsp;getCipherKey__](crypt-OpenSSLCrypt-getCipherKey.md) |  |
| [__OpenSSLCrypt&nbsp;::&nbsp;setCipherKey__](crypt-OpenSSLCrypt-setCipherKey.md) |  |
| [__OpenSSLCrypt&nbsp;::&nbsp;getCipherIv__](crypt-OpenSSLCrypt-getCipherIv.md) |  |
| [__OpenSSLCrypt&nbsp;::&nbsp;setCipherIv__](crypt-OpenSSLCrypt-setCipherIv.md) |  |
