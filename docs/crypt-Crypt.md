# [Crypt](crypt.md) / Crypt
 > im\crypt\Crypt
____

## Description
Defines a crypt class that can be used to encrypt/decrypt data
using a pre-defined cipher. The class may even work with
a shared key and iv value.

## Synopsis
```php
interface Crypt {

    // Constants
    DEF_IV = '8882e0f16f5815ea522d4771fae58161365603984768c7cd746ac2dc99a4dc25'
    DEF_KEY = 'db067721fd2d08f329b4e27e71656c0470da6fae483b47f1114b17ec8ef1239d6f509ef536e149f5a4c2af45edbf49c7f2cabec24de1a74121b3a6534c9572e0'

    // Methods
    getIvLength(): string
    getKeyLength(): string
    getCipherMode(): string
    getCipher(): string
    getCipherKey(): string
    setCipherKey(string $key): void
    createCipherIv(): null|string
    getCipherIv(): string
    setCipherIv(string $iv): void
    encrypt(string $data, string $key = NULL, string $iv = NULL): string
    decrypt(string $data, string $key = NULL, string $iv = NULL): string
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__Crypt&nbsp;::&nbsp;DEF\_IV__](crypt-Crypt-prop_DEF_IV.md) | Default IV value |
| [__Crypt&nbsp;::&nbsp;DEF\_KEY__](crypt-Crypt-prop_DEF_KEY.md) | Default Key |

## Methods
| Name | Description |
| :--- | :---------- |
| [__Crypt&nbsp;::&nbsp;getIvLength__](crypt-Crypt-getIvLength.md) | Get the length of the IV that is best suided for this cipher |
| [__Crypt&nbsp;::&nbsp;getKeyLength__](crypt-Crypt-getKeyLength.md) | Get the size best suided for the key that is to be used with the current cipher |
| [__Crypt&nbsp;::&nbsp;getCipherMode__](crypt-Crypt-getCipherMode.md) | Get the name of the cipher mode used by the current cipher |
| [__Crypt&nbsp;::&nbsp;getCipher__](crypt-Crypt-getCipher.md) | Get the name of the cipher currently used by this instance |
| [__Crypt&nbsp;::&nbsp;getCipherKey__](crypt-Crypt-getCipherKey.md) | Get the current shared cipher/encryption key |
| [__Crypt&nbsp;::&nbsp;setCipherKey__](crypt-Crypt-setCipherKey.md) | Set a new shared cipher/encryption key |
| [__Crypt&nbsp;::&nbsp;createCipherIv__](crypt-Crypt-createCipherIv.md) | Create a cipher iv that matches the requirements of the cipher |
| [__Crypt&nbsp;::&nbsp;getCipherIv__](crypt-Crypt-getCipherIv.md) | Get the current shared iv that is being used |
| [__Crypt&nbsp;::&nbsp;setCipherIv__](crypt-Crypt-setCipherIv.md) | Set a new shared cipher iv |
| [__Crypt&nbsp;::&nbsp;encrypt__](crypt-Crypt-encrypt.md) | Encrypts data using the specified cipher in this instance |
| [__Crypt&nbsp;::&nbsp;decrypt__](crypt-Crypt-decrypt.md) | Decrypts data using the specified cipher in this instance |
