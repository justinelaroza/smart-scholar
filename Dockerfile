# Stage 1 - Frontend Build
FROM node:18 AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2 - Laravel + PHP + Nginx
FROM php:8.2-fpm AS backend

RUN apt-get update && apt-get install -y nginx git curl unzip libpq-dev libonig-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy Laravel app
COPY . .

# Copy built frontend
COPY --from=frontend /app/public/build ./public/build

# Copy Nginx config
COPY ./nginx.conf /etc/nginx/conf.d/default.conf

RUN composer install --no-dev --optimize-autoloader

# Clear Laravel caches
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

EXPOSE 80

# Start both nginx and php-fpm
CMD service nginx start && php-fpm
