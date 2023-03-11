# Utiliser l'image de PHP
FROM php:8.2.3-apache

# Activer le module Apache Rewrite
RUN a2enmod rewrite

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Copier les fichiers de l'application dans le conteneur
COPY . /var/www/html/

# Définir le répertoire de travail par défaut
WORKDIR /var/www/html
