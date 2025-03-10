ARG PHP_VERSION=8.0
FROM php:${PHP_VERSION}-cli

RUN docker-php-ext-install calendar

ARG COVERAGE
RUN if [ "$COVERAGE" = "pcov" ]; then pecl install pcov && docker-php-ext-enable pcov; fi

# Install composer to manage PHP dependencies
RUN apt update && apt install -y git zip
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN echo "memory_limit = -1" > /usr/local/etc/php/conf.d/dates.ini

WORKDIR /app
RUN git config --global --add safe.directory /app
