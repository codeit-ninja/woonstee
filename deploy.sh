#!/bin/bash
now=$(date)
echo "-----------------------------------------------"
echo "Deployment at: $now"
echo "-----------------------------------------------"

if ! command -v composer &> /dev/null
then
    echo "composer could not be found"
    curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
    HASH=`curl -sS https://composer.github.io/installer.sig`
    php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
fi

if command -v composer &> /dev/null
then
    echo "composer was installed"
fi

composer install --no-interaction --no-dev --prefer-dist 2>&1
if [ $? -eq 0 ]; then
    echo "Composer packages installed"
else
    echo "Composer install failed"
    exit 1;
fi

# /opt/plesk/php/8.3/bin/php /usr/lib/plesk-9.0/composer.phar install
cd ~/httpdocs/web/app/themes/understrap-child && npm install && npm run dist