FROM php:8.0-apache

RUN apt-get update && apt-get install -y \
        libzip-dev \
        zip \
        libpq-dev \
	&& docker-php-ext-install zip \
        && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
        && docker-php-ext-install pdo pdo_pgsql pgsql \
        && a2enmod rewrite \
        && a2enmod actions
        
COPY 000-default.conf /etc/apache2/sites-enabled/000-default.conf

RUN service apache2 restart

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer