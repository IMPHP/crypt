<?php

/* ---
 * Include the ClassLoader
 */
require "../../base/src/ImClassLoader.php";

$loader = im\ImClassLoader::load();
$loader->addBasePath( realpath("../src") );

/*
 * ----------------------------------------
 */

use im\crypt\ImCrypt;
use im\crypt\ssl\OpenSSLCrypt;

$data = [];

for ($i=0; $i < 1000; $i++) {
    $data[] = random_bytes(512);
}

$im = new ImCrypt();
$ssl = new OpenSSLCrypt();

var_dump(strlen($ssl->encrypt(random_bytes(24)))); exit(0);



/* ---------------------------------------
 *  IM TEST
 */
echo "Starting ImCrypt test...\n";
$rustart = getrusage();

foreach ($data as $key => $value) {
    $cipherText = $im->encrypt($value);
    $plainText = $im->decrypt($cipherText);

    if ($plainText != $value) {
        throw new Exception("ImCrypt failed while comparing ($plainText != $value) at offset $key");
    }
}

$ru = getrusage();
printf("This process used %d ms for its computations\n", ($ru["ru_utime.tv_usec"] - $rustart["ru_utime.tv_usec"]) / 1000);


echo "\n";
/* ---------------------------------------
 *  SSL TEST
 */
 echo "Starting OpenSSLCrypt test...\n";
 $rustart = getrusage();

 foreach ($data as $key => $value) {
     $cipherText = $ssl->encrypt($value);
     $plainText = $ssl->decrypt($cipherText);

     if ($plainText != $value) {
         throw new Exception("ImCrypt failed while comparing ($plainText != $value) at offset $key");
     }
 }

 $ru = getrusage();
 printf("This process used %d ms for its computations\n", ($ru["ru_utime.tv_usec"] - $rustart["ru_utime.tv_usec"]) / 1000);
