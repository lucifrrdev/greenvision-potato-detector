FROM bitnamilegacy/laravel:10

# Set working directory
WORKDIR /app

# Copy seluruh file aplikasi Laravel ke dalam container
COPY . /app

# Jalankan composer install untuk mengunduh semua dependencies laravel
RUN composer install --no-dev --optimize-autoloader

# Expose port internal laravel
EXPOSE 8000

