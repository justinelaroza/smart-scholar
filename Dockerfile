# ================================
# Base Image
# ================================
FROM php:8.2-fpm

WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip nginx libpq-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libonig-dev zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Node.js (for Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Copy Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files
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
 && php artisan view:clear \
 && php artisan storage:link || true

# Copy Nginx configuration
COPY ./nginx.conf /etc/nginx/conf.d/default.conf

# Expose web port
EXPOSE 80

# Start PHP-FPM and Nginx
CMD php-fpm & nginx -g "daemon off;"
