FROM php:8.2-cli

WORKDIR /var/www/html

# Instala dependências do sistema
RUN apt-get update && \
    apt-get install -y libpng-dev libonig-dev libxml2-dev zip unzip git && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia arquivos do projeto
COPY . .

# Instala dependências PHP
RUN composer install

# Permissões para o storage e cache do Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Porta exposta
EXPOSE 8000

# Comando para rodar o servidor embutido
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
