FROM php:8.2-cli

# Dépendances système de base
RUN apt-get update && apt-get install -y \
    unzip zip curl git nodejs npm openssh-client sshpass \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Créer un utilisateur non-root (optionnel)
RUN useradd -ms /bin/bash laraveluser

WORKDIR /app
USER laraveluser
