# Laravel application Docker image
FROM php:8.4-cli-alpine

# Copy composer binary dari official composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install dependencies untuk composer (unzip untuk zip archive, git untuk vcs dependencies)
RUN apk add --no-cache unzip git

# Set working directory
WORKDIR /var/www/html

# Layer 1: Copy composer files (jarang berubah, akan di-cache)
COPY composer.json composer.lock ./

# Layer 2: Install PHP dependencies tanpa scripts dan autoloader
# --no-scripts: skip post-install scripts yang butuh artisan
# --no-autoloader: autoloader dibangun nanti setelah kode aplikasi disalin
# --no-dev: skip dev dependencies (phpunit, pint, dll)
# --prefer-dist: download zip distribution, lebih cepat
RUN composer install --no-scripts --no-autoloader --no-dev --prefer-dist

# Layer 3: Copy seluruh application code (sering berubah)
# database.sqlite ikut tersalin di sini (COPY . . membawa semua kecuali yang di .dockerignore)
COPY . .

# Layer 4: Finalize autoloader dan setup direktori
RUN composer dump-autoload --optimize && \
    mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# Expose port untuk artisan serve
EXPOSE 8000

# Run Laravel development server
# --host=0.0.0.0 agar bisa diakses dari luar container
# --port=8000 sesuai EXPOSE di atas
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
