# Build stage: install dependencies
FROM php:8.4.26-cli-alpine3.24 AS build

# Copy composer binary dari official composer image (pinned version)
COPY --from=composer:2.10.3 /usr/bin/composer /usr/bin/composer

# Install dependencies untuk composer
RUN apk add --no-cache unzip git

# Set working directory
WORKDIR /var/www/html

# Layer 1: Copy composer files (jarang berubah, akan di-cache)
COPY composer.json composer.lock ./

# Layer 2: Install PHP dependencies tanpa scripts dan autoloader
RUN composer install --no-scripts --no-autoloader --no-dev --prefer-dist

# Layer 3: Copy seluruh application code
COPY . .

# Layer 4: Finalize autoloader
RUN composer dump-autoload --optimize --no-dev

# Runtime stage: lean production image
FROM php:8.4.26-cli-alpine3.24

# Metadata
LABEL org.opencontainers.image.source=https://github.com/KEPL2026/evolusi-pl-24-539132-SV-24568

# Set working directory
WORKDIR /var/www/html

# Copy application dari build stage
COPY --from=build /var/www/html /var/www/html

# Create non-root user
RUN adduser -D app && \
    mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache && \
    chown -R app:app storage bootstrap/cache database

# Switch to non-root user
USER app

# Expose port
EXPOSE 8000

# Health check menggunakan wget (tersedia di alpine)
HEALTHCHECK --interval=15s --timeout=3s --start-period=10s --retries=3 \
    CMD wget -q -O /dev/null http://127.0.0.1:8000/up || exit 1

# Run Laravel development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
