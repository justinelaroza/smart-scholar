# ================================
# Base image
# ================================
FROM php:8.2-fpm

WORKDIR /var/www

# Install system deps
RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libonig-dev zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Node.js (for Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Copy Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy app
COPY . .

# Permissions
RUN chmod -R 777 storage bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install and build frontend
RUN npm install \
 && npm run build \
 && echo "=== BUILD OUTPUT ===" \
 && ls -R public/build || echo "no build folder found"

# Clear caches and link storage
RUN php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear

EXPOSE 8000

# Run migrations and start server
CMD php artisan migrate --force \
 && php artisan storage:link \
 && php artisan serve --host=0.0.0.0 --port=$PORT
