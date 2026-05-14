FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    zip \
    libzip-dev \
    libpq-dev \
    default-mysql-client \
    nodejs \
    npm \
    && docker-php-ext-install \
    pdo \
    pdo_pgsql \
    pdo_mysql \
    zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

# Install frontend dependencies
RUN npm install

# Build Vite assets
RUN npm run build

RUN ls -la public/build
RUN ls -la public/build/assets

# Laravel permissions
RUN chmod -R 775 storage bootstrap/cache

# Clear caches
RUN php artisan config:clear

# Create storage symlink safely
RUN php artisan storage:link || true

# Expose Render port
EXPOSE 10000

# Start application
CMD php artisan migrate --force || true && \
    php artisan optimize:clear && \
    php -S 0.0.0.0:10000 -t public