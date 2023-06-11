FROM alessandrolanni/php8.1-apache-custom-debug

ADD dev.php.ini /usr/local/etc/php/conf.d/dev.php.ini

USER webapp