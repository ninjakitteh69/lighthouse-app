FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
    nodejs \
    npm \
    chromium \
    python3 \
    python3-aiofiles
RUN npm install -g lighthouse
RUN mkdir -p /var/www/html/uploads

WORKDIR /app
COPY ./dist/app /app
COPY ./dist/web /var/www/html
RUN chown -R www-data:www-data /var/www/html