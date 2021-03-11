# [Crypt](crypt.md) / [Crypt](crypt-Crypt.md) :: setCipherKey
 > im\crypt\Crypt
____

## Description
Set a new shared cipher/encryption key .

By default the script uses a default shared key, this key should not
be used in production, so it's best to set a new key,
if you plan on using a shared key with this instance.

## Synopsis
```php
setCipherKey(string $key): void
```

## Parameters
| Name | Description |
| :--- | :---------- |
| key | The new cipher/encryption key |
