# [Crypt](crypt.md) / [Crypt](crypt-Crypt.md) :: decrypt
 > im\crypt\Crypt
____

## Description
Decrypts data using the specified cipher in this instance

## Synopsis
```php
decrypt(string $data, string $key = NULL, string $iv = NULL): string
```

## Parameters
| Name | Description |
| :--- | :---------- |
| data | The data to decrypt |
| key | The cipher/encryption key that was used to encrypt the data<br />If no cipher/encryption key is specified, the shared key will be used. |
| iv | The IV that was used to encrypt the data<br />If no IV is specified, the shared IV will be used. |
