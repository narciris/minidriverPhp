#Imagen de php con el servidor de php apache
FROM php:8.2-apache

LABEL authors="nar programmer"

#Extensiones de PDO
#Por defecto el contenedor de docker no trae la extension de pdo
#Para conectarse  bases de datos
RUN docker-php-ext-install pdo pdo_mysql

# Composer
#copia composer desde una imagen oficial de docker a el contenedor
#docker es el gestor de dependencias de php
#permite instalar librerias en este caso para instalar el sdk de aws
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Activar mod_rewrite
#Modulo de apache que permite reescribir URLS de forma flexible
RUN a2enmod rewrite

# Establecer el directorio de trabajo
WORKDIR /var/www/html/

# Copiar composer.json primero para aprovechar la caché de Docker
COPY composer.json composer.lock* ./

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip


# Instalar dependencias con Composer (incluido AWS SDK)
RUN composer install --no-scripts --no-autoloader

# Copiar el resto de archivos del proyecto
COPY . .

# Generar autoloader optimizado
RUN composer dump-autoload --optimize

# Configuración personalizada del Apache
RUN chown -R www-data:www-data /var/www/html
