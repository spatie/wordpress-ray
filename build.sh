#!/bin/bash

echo "# Removing the vendor folder..."

rm -r -f vendor
rm composer.lock

echo "# Composer install with dev dependencies..."

composer install

composer bin php-scoper require --dev humbug/php-scoper

echo "# Executing PHP Scoper..."

vendor/bin/php-scoper add-prefix --force

echo "# Tweaking the build folder..."

cd build

composer update nothing --no-dev

composer dump-autoload

mv vendor-bin/php-scoper/vendor/scoper-autoload.php vendor/

rm -r src

rm -r vendor-bin

rm -r composer.json

rm -r composer.lock

cd ../

echo "# Replacing the vendor folder with the build version..."

rm -r -f vendor

mv build/vendor vendor

rm -r -f build

echo "# Generating custom autoloader..."

php <<\EOF
<?php
$autoload = str_replace(['<?php', 'return'], ['', '$output = '],file_get_contents('vendor/autoload.php'));
$scoperAutoload = file_get_contents('vendor/scoper-autoload.php');
$scoperAutoload = str_replace('$loader = require_once __DIR__.\'/autoload.php\';', $autoload, $scoperAutoload);
file_put_contents('vendor/ray-autoload.php',$scoperAutoload);
EOF

rm vendor/scoper-autoload.php

cat << "EOF"
.______        ___      .___  ___.    .______        ___      .___  ___.    .______        ___           ___       __    __
|   _  \      /   \     |   \/   |    |   _  \      /   \     |   \/   |    |   _  \      /   \         /   \     |  |  |  |
|  |_)  |    /  ^  \    |  \  /  |    |  |_)  |    /  ^  \    |  \  /  |    |  |_)  |    /  ^  \       /  ^  \    |  |__|  |
|   ___/    /  /_\  \   |  |\/|  |    |   ___/    /  /_\  \   |  |\/|  |    |   ___/    /  /_\  \     /  /_\  \   |   __   |
|  |       /  _____  \  |  |  |  |    |  |       /  _____  \  |  |  |  |    |  |       /  _____  \   /  _____  \  |  |  |  |
| _|      /__/     \__\ |__|  |__|    | _|      /__/     \__\ |__|  |__|    | _|      /__/     \__\ /__/     \__\ |__|  |__|
EOF