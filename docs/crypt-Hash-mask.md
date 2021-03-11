# [Crypt](crypt.md) / [Hash](crypt-Hash.md) :: mask
 > im\crypt\Hash
____

## Description
This method will obfuscate data using a Secret/Password

## Synopsis
```php
mask(string $data, null|string $secret = NULL): string
```

## Parameters
| Name | Description |
| :--- | :---------- |
| data | Data to obfuscate |
|  | Secret/Password that will be used to obfuscate the data<br />If no secret/password is specified, the shared secret will be used. |
