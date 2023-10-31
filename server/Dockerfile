# Basierend auf dem offiziellen PHP-Image mit FPM
FROM php:8.2-fpm

# Pakete aktualisieren und notwendige Bibliotheken installieren
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev

# PHP-Erweiterungen installieren
RUN docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql zip

# Xdebug installieren, wenn es noch nicht installiert ist
RUN if ! pecl list | grep -q xdebug; then \
    pecl uninstall -r xdebug; \
    pecl install xdebug && docker-php-ext-enable xdebug; \
    fi

# Alternativ: Xdebug immer neu installieren
# RUN pecl uninstall -r xdebug && pecl install xdebug && docker-php-ext-enable xdebug

# Setzen des Arbeitsverzeichnisses im Container
WORKDIR /var/www/html

# Benutzerdefinierte PHP-Ini Einstellungen kopieren
COPY php.ini $PHP_INI_DIR/conf.d/custom.ini
