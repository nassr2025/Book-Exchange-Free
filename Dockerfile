# استخدم صورة PHP الرسمية مع Apache
FROM php:8.2-apache
RUN docker-php-ext-install mysqli
# نسخ ملفات المشروع إلى مجلد السيرفر
COPY . /var/www/html/

# فتح المنفذ 80
EXPOSE 80

