# [Crypt](crypt.md) / [Hash](crypt-Hash.md) :: compareHash
 > im\crypt\Hash
____

## Description
Compare two hash values

This method is a timing attack safe comparison method.
In any case where you need to compare two hash values that
is connected to user input, you should use this method rather than
doing a simple `hash1 == hash2`. For internal comparison it has no impact.

## Synopsis
```php
compareHash(string $hash1, string $hash2): bool
```

## Parameters
| Name | Description |
| :--- | :---------- |
| hash1 | Hash to compare against |
| hash2 | Hash to compare |
