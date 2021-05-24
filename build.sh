#!/bin/bash

echo "Removing the previous dependecies folder if it exists."

rm -r -f dependencies || true

echo "Executing PHP Scoper."

vendor/bin/php-scoper add-prefix --force

cd build

composer dump-autoload

mv vendor-bin/php-scoper/vendor/scoper-autoload.php vendor/

rm -r src

rm -r vendor-bin

rm -r composer.json

rm -r composer.lock

echo "Applying patches."

php <<\EOF
<?php
$find = "'Spatie\\\\WordPressRay\\\\' => \n        array (\n            0 => __DIR__ . '/../..' . '/src',\n";
$replace = "'Spatie\\\\WordPressRay\\\\' => \n        array (\n            0 => __DIR__ . '/../../..' . '/src',\n";
file_put_contents('vendor/composer/autoload_static.php',str_replace($find, $replace, file_get_contents('vendor/composer/autoload_static.php')));
EOF

cd ../

mv build dependencies

echo "Done!"

cat << "EOF"
.______        ___      .___  ___.    .______        ___      .___  ___.    .______        ___           ___       __    __
|   _  \      /   \     |   \/   |    |   _  \      /   \     |   \/   |    |   _  \      /   \         /   \     |  |  |  |
|  |_)  |    /  ^  \    |  \  /  |    |  |_)  |    /  ^  \    |  \  /  |    |  |_)  |    /  ^  \       /  ^  \    |  |__|  |
|   ___/    /  /_\  \   |  |\/|  |    |   ___/    /  /_\  \   |  |\/|  |    |   ___/    /  /_\  \     /  /_\  \   |   __   |
|  |       /  _____  \  |  |  |  |    |  |       /  _____  \  |  |  |  |    |  |       /  _____  \   /  _____  \  |  |  |  |
| _|      /__/     \__\ |__|  |__|    | _|      /__/     \__\ |__|  |__|    | _|      /__/     \__\ /__/     \__\ |__|  |__|
EOF