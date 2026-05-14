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
RUN composer install --optimize-autoloader --no-dev

# Install frontend dependencies
RUN npm install

# Build frontend assets
RUN npm run build

# IMPORTANT: Remove Vite dev server file
RUN rm -f public/hot

# Laravel permissions
RUN chmod -R 775 storage bootstrap/cache

# Clear Laravel config
RUN php artisan config:clear

# Create storage symlink safely
RUN php artisan storage:link || true

# Expose Render port
EXPOSE 10000

# Start Laravel application
CMD php artisan migrate --force || true && \
    php artisan optimize:clear && \
    php -S 0.0.0.0:10000 -t public