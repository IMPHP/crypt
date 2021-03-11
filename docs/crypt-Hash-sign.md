# [Crypt](crypt.md) / [Hash](crypt-Hash.md) :: sign
 > im\crypt\Hash
____

## Description
Create a signature from specified data

## Synopsis
```php
sign(string $data, string $secret = NULL): string
```

## Parameters
| Name | Description |
| :--- | :---------- |
| data | Data to create a signature from |
| secret | Secret/Password to used for the signature<br />If no secret/password is specified, the shared secret will be used. |

## Return
The signature
