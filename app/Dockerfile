FROM bitnamilegacy/laravel:10

# Set working directory
WORKDIR /app

# Copy seluruh file aplikasi Laravel ke dalam container
COPY . /app

# Jalankan composer install untuk mengunduh semua dependencies laravel
RUN composer install --no-dev --optimize-autoloader

# Sesuaikan kepemilikan dan permission agar user 1001 (default Bitnami) bisa menulis cache & logs
RUN chown -R 1001:1001 /app && \
    chmod -R 775 /app/storage /app/bootstrap/cache

# Expose port internal laravel
EXPOSE 8000


