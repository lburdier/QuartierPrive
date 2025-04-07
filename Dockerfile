FROM lorisleiva/laravel-docker:stable

USER root

RUN apt-get update && apt-get install -y sshpass && rm -rf /var/lib/apt/lists/*

USER laravel
