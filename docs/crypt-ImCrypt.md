# [Crypt](crypt.md) / ImCrypt
 > im\crypt\ImCrypt
____

## Description
An implementation of `im\crypt\Crypt`.

This is mostly intented as a base class for other crypt
classes. However it is made as a full working class by adding
a small obfuscating encryption feature that does not rely on any external
encryption support. It's a last case meassure and should be avoided when possible.

 - First of all it's not very safe. It does provide a small form of security, as
   most people do not possess cryptographic knolege to break things like this,
   and for those that do, your data may not be worth the trouble. But don't think that
   this will make NSA go home crying at knight. Use the OpenSSL crypt class if possible.

 - Second, if your data does not have to be absolutly safe, you could have used this for the performance
   bennefits compared to a hardcore encryption algo? Again, no. This is actually slower than
   encrypting a 256bit AES with OpenSSL.

## Synopsis
```php
class ImCrypt implements im\crypt\Crypt {

    // Inherited Constants
    public DEF_IV = '8882e0f16f5815ea522d4771fae58161365603984768c7cd746ac2dc99a4dc25'
    public DEF_KEY = 'db067721fd2d08f329b4e27e71656c0470da6fae483b47f1114b17ec8ef1239d6f509ef536e149f5a4c2af45edbf49c7f2cabec24de1a74121b3a6534c9572e0'

    // Methods
    public __construct()
    public getIvLength(): string
    public getKeyLength(): string
    public getCipherMode(): string
    public getCipher(): string
    public getCipherKey(): string
    public setCipherKey(null|string $key): void
    public createCipherIv(): null|string
    public getCipherIv(): string
    public setCipherIv(null|string $iv): void
    public encrypt(string $data, null|string $key = NULL, null|string $iv = NULL): string
    public decrypt(string $data, null|string $key = NULL, null|string $iv = NULL): string
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__ImCrypt&nbsp;::&nbsp;DEF\_IV__](crypt-ImCrypt-prop_DEF_IV.md) | Default IV value |
| [__ImCrypt&nbsp;::&nbsp;DEF\_KEY__](crypt-ImCrypt-prop_DEF_KEY.md) | Default Key |

## Methods
| Name | Description |
| :--- | :---------- |
| [__ImCrypt&nbsp;::&nbsp;\_\_construct__](crypt-ImCrypt-__construct.md) |  |
| [__ImCrypt&nbsp;::&nbsp;getIvLength__](crypt-ImCrypt-getIvLength.md) |  |
| [__ImCrypt&nbsp;::&nbsp;getKeyLength__](crypt-ImCrypt-getKeyLength.md) |  |
| [__ImCrypt&nbsp;::&nbsp;getCipherMode__](crypt-ImCrypt-getCipherMode.md) |  |
| [__ImCrypt&nbsp;::&nbsp;getCipher__](crypt-ImCrypt-getCipher.md) |  |
| [__ImCrypt&nbsp;::&nbsp;getCipherKey__](crypt-ImCrypt-getCipherKey.md) |  |
| [__ImCrypt&nbsp;::&nbsp;setCipherKey__](crypt-ImCrypt-setCipherKey.md) |  |
| [__ImCrypt&nbsp;::&nbsp;createCipherIv__](crypt-ImCrypt-createCipherIv.md) |  |
| [__ImCrypt&nbsp;::&nbsp;getCipherIv__](crypt-ImCrypt-getCipherIv.md) |  |
| [__ImCrypt&nbsp;::&nbsp;setCipherIv__](crypt-ImCrypt-setCipherIv.md) |  |
| [__ImCrypt&nbsp;::&nbsp;encrypt__](crypt-ImCrypt-encrypt.md) | An obfuscating method that requires no encryption extension  This method will obfuscate data using a key, salt and a CBC block mode method |
| [__ImCrypt&nbsp;::&nbsp;decrypt__](crypt-ImCrypt-decrypt.md) |  |
