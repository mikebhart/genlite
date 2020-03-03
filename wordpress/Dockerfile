FROM wordpress:5.2.4-php7.3-apache
COPY genlite-php.ini /usr/local/etc/php/conf.d/

WORKDIR /var/www/html
ADD --chown=www-data:www-data index.php wp-content/index.php
ADD --chown=www-data:www-data index.php wp-content/uploads/index.php
ADD --chown=www-data:www-data index.php wp-content/themes/index.php
ADD --chown=www-data:www-data index.php wp-content/plugins/index.php


