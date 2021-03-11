# [Crypt](crypt.md) / [Hash](crypt-Hash.md) :: createKdf2
 > im\crypt\Hash
____

## Description
Create a cryptographic hash value

## Synopsis
```php
createKdf2(int $size, string $secret = NULL, string $salt = NULL): string
```

## Parameters
| Name | Description |
| :--- | :---------- |
| size | Size of the output value |
| secret | Secret/Password that will be used to create the hash value.<br />If no secret/password is specified, the shared secret will be used. |
| salt | Salt value that will be used when creating the hash value.<br />You can use `createSalt()` to create a proper salt value.<br />If no salt value is specified, the shared salt value will be used. |

## Return
The hash value in binary format
