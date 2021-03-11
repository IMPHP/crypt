# [Crypt](crypt.md) / [ImCrypt](crypt-ImCrypt.md) :: encrypt
 > im\crypt\ImCrypt
____

## Description
An obfuscating method that requires no encryption extension

This method will obfuscate data using a key, salt and a CBC block mode method.
This is nowhere near a real encryption mecanism, but it is still a lot better than
a simple obfuscating method or just plain text. It can be a good addition when your
server administrative possibilites are limited and your current installment does not have
any real encryption extensions available. The best option however would be to use
the `im\crypt\ssl\OpenSSLCrypt` class, if possible.

 > If the data is exstreamly sensitive, don't use this at all. If someone really want's the data and has the knowhow, this might annoy them a bit, but it will most likely not stop them.  

## Synopsis
```php
public encrypt(string $data, null|string $key = NULL, null|string $iv = NULL): string
```
