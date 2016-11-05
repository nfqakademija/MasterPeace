#!/bin/bash

composer install &&
php bin/console cache:clear &&

php bin/console doctrine:schema:drop --force &&
php bin/console doctrine:schema:create &&
php bin/console doctrine:fixtures:load --no-interaction &&

vendor/bin/phpcs --standard=PSR2 src &&
vendor/bin/phpunit --coverage-text