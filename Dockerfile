FROM lorisleiva/laravel-docker:stable

USER root

RUN apk update && apk add --no-cache sshpass

USER laravel
