#!/bin/bash

if [ ! -f /usr/src/unicorn/vendor/autoload.php ]; then
    echo "Autoload file not found! Installing dependencies..."
    composer selfupdate
    composer install
fi

echo "Running unicorn..."
cd /usr/src/unicorn
ls -la
php srv.php
