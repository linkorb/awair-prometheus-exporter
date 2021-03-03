FROM docker.pkg.github.com/linkorb/php-docker-base/php-docker-base:latest

EXPOSE 80

ENV APP_ENV=prod

COPY --chown=www-data:www-data . /app

WORKDIR /app

USER www-data
RUN /usr/bin/composer install --no-scripts --no-dev
USER root

ENTRYPOINT ["apache2-foreground"]
