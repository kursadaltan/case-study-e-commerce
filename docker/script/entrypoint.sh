#!/bin/sh
cd /var/www/html && composer install
/usr/bin/supervisord -c /etc/supervisor/supervisord.conf