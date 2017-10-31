FROM php:5.6.31-cli
RUN apt-get update && apt-get -y install git subversion ghostscript libmagickwand-dev --no-install-recommends
RUN pecl install imagick && docker-php-ext-enable imagick && docker-php-ext-install -j$(nproc) zip
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

