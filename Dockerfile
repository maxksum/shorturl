# Используйте официальный образ PHP с Apache
FROM php:8.1-apache

# Установка утилиты ping
RUN apt-get update && apt-get install -y iputils-ping

# Установите необходимые расширения PHP
RUN docker-php-ext-install pdo_mysql mysqli

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Копируем все файлы проекта в образ
COPY . /var/www/html

# Установим зависимости Composer
RUN composer install --no-interaction --optimize-autoloader

# Установим права на директории и файлы
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Настроим Apache
RUN a2enmod rewrite
RUN service apache2 restart

# Открываем порт 80
EXPOSE 80

# Команда для запуска приложения
CMD ["apache2-foreground"]
