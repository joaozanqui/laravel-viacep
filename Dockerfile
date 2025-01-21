FROM php:8.0.2-apache

USER root

WORKDIR /var/www/html

RUN ln -s public html

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    vim \
    joe \
    libpng-dev \
    libxml2-dev \
    zlib1g-dev \
    libzip-dev zip unzip
    
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install mysqli pdo pdo_mysql gd zip

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apt-get update -yq \
    && curl -L https://deb.nodesource.com/setup_16.x | bash \
    && apt-get update -yq \
    && apt-get install -yq \
    nodejs

COPY . /var/www/html/

COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
RUN service apache2 restart
RUN chmod -R 777 ./storage