# [Crypt](crypt.md) / [Hash](crypt-Hash.md) :: unmask
 > im\crypt\Hash
____

## Description
Restores previously obfuscated data to it's original state

## Synopsis
```php
unmask(string $data, string $secret = NULL): string
```

## Parameters
| Name | Description |
| :--- | :---------- |
| data | The obfuscated data to restore |
| secret | Secret/Password that was used to obfuscate the data<br />If no secret/password is specified, the shared secret will be used. |
