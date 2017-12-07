AMFExt (native) 0.9
===============

This project is focused on adjustments on the original AMFEXT project from Emanuele Ruffaldi posted on PECL. You can check it in this address: http://pecl.php.net/package/amfext.

The main purpose is to mantain compatibility with new versions of PHP.

This extension implements the ActionScript Message Format 
for encoding and decoding,both in AMF and AMF3 versions.

This extension provides two low level functions useful for
encoding and decoding objects into AMF format, but it does
not provide functions for managing the full message.

Details on the encoding process can be read in doc/encoding.txt

Documentation on the PHP function and the callbacks is in doc/amfextdoc.php

Constants for the flags that can be used in the encoding/decoding are in amfext.php
that can be included.


Known Builds
===============

We currently have the following branches:

Master - Tested with PHP 5.4.x, 5.5.14 and PHP 5.6.2 in LINUX (CentOS, Arch Linux, Ubuntu and Debian)
         Tested with PHP 5.4.x MAC OSX (Snow, Lion and Mountain)

PHP53x - Tested with PHP 5.3.x in Linux (CentOS, Arch Linux, Ubuntu and Debian)
         Tested with PHP 5.3.x MAC OSX (Snow, Lion and Mountain)
         Used for over a year in production environment - CentOS

PHP54x - Tested with PHP 5.4.x in Linux (CentOS, Arch Linux, Ubuntu and Debian) 
         Tested with PHP 5.4.x MAC OSX (Snow, Lion and Mountain)
         Being used for over a year in production environment - CentOS
         
PHP55x - In development



How to Install
===============

Clone this repository and build:

```sh
git clone https://github.com/protetore/amfext.git
cd amfext
phpize
chmod +x configure && chmod +x build/shtool # in some cases
./configure
make clean
make
sudo make intall
```
