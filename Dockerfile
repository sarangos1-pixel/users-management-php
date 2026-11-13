
# CRUD Usuarios / Estudiantes - Imagen PHP 8.3 + Apache

FROM php:8.3-apache

# Extension PDO para MySQL (la app usa PDO con el driver mysql)
RUN docker-php-ext-install pdo_mysql \
    && a2enmod rewrite

# El .htaccess del proyecto necesita AllowOverride All para que
# funcionen las reglas de reescritura hacia public/index.php
RUN sed -ri 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# La raiz del proyecto es el DocumentRoot: el CSS y el JS se sirven
# desde Infrastructure/... y el front controller esta en public/index.php
WORKDIR /var/www/html
COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
