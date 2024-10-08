# Use uma imagem base do PHP
FROM php:8.3-fpm

# Instale as dependências do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip

# Instale o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Defina o diretório de trabalho
WORKDIR /app

# Copie os arquivos do projeto
COPY . .

# Instale as dependências do Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Exponha a porta do PHP-FPM
EXPOSE 9000

# Inicie o PHP-FPM
CMD ["php-fpm"]
