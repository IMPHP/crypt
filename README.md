# IMPHP - Crypt
___

This library provides hash and encryption tools that makes a lot easier to work with both of those things. Rather than having cipher and algorithm, cipher keys, hash secrets and so on, spread around in your entire project, this crypt package enables you to deal with all of this in one place and then make use it from anywhere.

__Cipher & Hash algorithm__  
This is setup during initialization of the class instances. From here you can simply forward these instances to anywhere in your project, and it will all make use of the same ciphers and algorithms when creating hash values, encrypting data and so fourth.

__Secret, Cipher Key & Salt/IV__  
Maybe you would want to create keyed hash values of passwords before database storage? Or you might want to sign and/or encrypt cookie data? Maybe do something to session data? But you don't want to deal with setting up secrets and salt values or iv's and cipher keys directly in a custom cookie, session library or a login page. The crypt package allows you to specify shared secrets/salts and keys/iv's within each of the respected instances. These can be used across your project, allowing your cookie/session library and your login/create profile page to only deal with the actual encryption/decryption and hash work.

### Example

```php
$crypt = new OpenSSLCrypt("aes-256-cbc");
$crypt->setCipherKey($key);
$crypt->setCipherIv($iv);

// Encrypt data
$cipherText = $crypt->encrypt($data);

// Decrypt
$data = $crypt->decrypt($cipherText);
```

### Full Documentation

You can view the [Full Documentation](docs/crypt.md) to lean more.

### Installation

__Clone via git__

```sh
git clone https://github.com/IMPHP/crypt.git imphp/crypt/
```

__Composer _(Packagist)___

```sh
composer require imphp/crypt
```
