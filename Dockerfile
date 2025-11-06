# ===============================
# Stage 1 — Build Frontend (Vite)
# ===============================
FROM node:18 AS frontend

WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# ===============================
# Stage 2 — Laravel + PHP-FPM + Nginx
# ===============================
FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    nginx git curl unzip libpq-dev libonig-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy Laravel app
COPY . .

# Copy built frontend
COPY --from=frontend /app/public/build ./public/build

# Copy Nginx config (see below)
COPY ./nginx.conf /etc/nginx/conf.d/default.conf

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Clear Laravel caches
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

# Expose Render's dynamic port
EXPOSE 10000

# Start Nginx and PHP-FPM (Render sets $PORT automatically)
CMD service nginx start && php-fpm
