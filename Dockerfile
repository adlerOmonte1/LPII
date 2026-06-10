FROM php:8.2-apache

# Extensión PDO para PostgreSQL (Supabase)
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

RUN echo "output_buffering = 4096" > /usr/local/etc/php/conf.d/buffering.ini

# Copiar la aplicación al document root de Apache
COPY . /var/www/html/

# Render expone el puerto vía $PORT; Apache escucha en él
ENV PORT=10000
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf
EXPOSE 10000