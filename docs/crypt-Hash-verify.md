# [Crypt](crypt.md) / [Hash](crypt-Hash.md) :: verify
 > im\crypt\Hash
____

## Description
Verify a signature

## Synopsis
```php
verify(string $data, string $signature, string $secret = NULL): bool
```

## Parameters
| Name | Description |
| :--- | :---------- |
| data | The data to check |
| signature | The signature to verify |
| secret | Secret/Password that was used to create the signature<br />If no secret/password is specified, the shared secret will be used. |
