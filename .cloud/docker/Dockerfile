FROM php:7.2-fpm

# Installing dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    mysql-client \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    jpegoptim optipng pngquant gifsicle

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Installing extensions
RUN docker-php-ext-install mbstring zip exif pcntl bcmath opcache
RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd

# # Memory Limit
# RUN echo "memory_limit=1024M" > $PHP_INI_DIR/conf.d/memory-limit.ini
# RUN echo "max_execution_time=200" >> $PHP_INI_DIR/conf.d/memory-limit.ini
# RUN echo "extension=apcu.so" > $PHP_INI_DIR/conf.d/apcu.ini
# RUN echo "post_max_size=1M" >> $PHP_INI_DIR/conf.d/memory-limit.ini
# RUN echo "upload_max_filesize=210M" >> $PHP_INI_DIR/conf.d/memory-limit.ini
#
# # Time Zone
# #RUN echo "date.timezone=${PHP_TIMEZONE:-UTC}" > $PHP_INI_DIR/conf.d/date_timezone.ini
#
#
# # Disable PathInfo
# RUN echo "cgi.fix_pathinfo=0" > $PHP_INI_DIR/conf.d/path-info.ini
#
# # Disable expose PHP
# RUN echo "expose_php=0" > $PHP_INI_DIR/conf.d/path-info.ini


# Allow container to write on host
RUN usermod -u 1000 www-data

# Changing Workdir
WORKDIR /application

#Laravel tunning


RUN cd /application/ \
    composer dumpautoload -o \
    php artisan config:clear \
    php artisan config:cache \
    php artisan optimize \
    php artisan route:clear \
    php artisan route:cache
