# [Crypt](crypt.md) / [Crypt](crypt-Crypt.md) :: getIvLength
 > im\crypt\Crypt
____

## Description
Get the length of the IV that is best suided for this cipher.

Note that any IV that is smaller than this recommented size,
will get auto generated data added to it. This data can be
replicated each time, allowing the same IV to work.

Any IV that is larger than this recommented size,
will be truncated.

The best option is to add a valid sized IV, but the second option
would be to add a larger IV that can be truncated instead, as it would
likely make for a stronger IV than building on one that is to small.

You can use `createCipherIv()` to create a valid IV,
that is best fitted the current cipher.

## Synopsis
```php
getIvLength(): string
```
