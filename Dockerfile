# ================================
# Base image with Apache
# ================================
FROM php:8.2-apache

WORKDIR /var/www/html

# Enable Apache modules
RUN a2enmod rewrite

# Install system dependencies
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

# Copy application files
COPY . .

# Set Apache document root to Laravel's public directory
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Add Apache configuration for Laravel
RUN echo '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/sites-available/000-default.conf

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies and build assets
RUN npm install && npm run build

# Clear Laravel caches
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan storage:link || true

# Configure Apache to use PORT environment variable
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Expose port
EXPOSE 8000

# Start script
CMD sed -i "s/80/${PORT:-8000}/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf && \
    php artisan migrate --force && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    apache2-foreground