FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring zip exif pcntl bcmath \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN mkdir -p storage/framework/{sessions,views,cache} bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

RUN sed -i 's/Listen 80/Listen ${PORT:-80}/' /etc/apache2/ports.conf \
    && sed -i 's/:80>/:${PORT:-80}>/' /etc/apache2/sites-available/000-default.conf

CMD ["sh", "-c", "sed -i \"s/80/${PORT:-80}/g\" /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf && php artisan config:clear && php artisan migrate --force && php artisan db:seed --force && apache2-foreground"]
