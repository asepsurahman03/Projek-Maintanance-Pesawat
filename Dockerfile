FROM php:8.2-fpm-alpine

# Install system dependencies & PHP extensions
RUN apk add --no-cache \
    nginx \
    nodejs \
    npm \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    icu-dev \
    sqlite-dev \
    linux-headers \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite bcmath gd intl zip opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN npm install && npm run build

# Setup permissions & SQLite database fallback
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache \
    && touch /var/www/html/database/database.sqlite \
    && chmod 777 /var/www/html/database/database.sqlite

# Configure Nginx
RUN mkdir -p /run/nginx
COPY nginx.conf /etc/nginx/http.d/default.conf

# Expose port
EXPOSE 80

# Start script
CMD ["sh", "-c", "php artisan migrate --force && php-fpm -D && nginx -g 'daemon off;'"]
