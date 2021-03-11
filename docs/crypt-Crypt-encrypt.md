# [Crypt](crypt.md) / [Crypt](crypt-Crypt.md) :: encrypt
 > im\crypt\Crypt
____

## Description
Encrypts data using the specified cipher in this instance

## Synopsis
```php
encrypt(string $data, string $key = NULL, string $iv = NULL): string
```

## Parameters
| Name | Description |
| :--- | :---------- |
| data | The data to encrypt |
| key | The cipher/encryption key to use for the encryption<br />If no cipher/encryption key is specified, the shared key will be used. |
| iv | The IV to use with the encryption<br />If no IV is specified, the shared IV will be used. |
