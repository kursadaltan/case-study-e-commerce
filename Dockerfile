FROM php:8.1-fpm-alpine3.17


LABEL MAINTAINER="Kursad ALTAN, <iletisim@kursadaltan.com" \
                "Description"="SSTTek Case Study E-Commerce Export Module"

# Install system dependencies
RUN apk update && \
    apk upgrade && \
    apk add wget libpng-dev libxml2-dev alien supervisor nano busybox-suid openrc && \
    apk --no-cache add curl linux-headers
#    apk add git wget libpng-dev libxml2-dev alien supervisor nano busybox-suid openrc && \

# Install PHP extensions
RUN set -ex; \
	\
	apk add --no-cache --virtual .build-deps \
		$PHPIZE_DEPS \
        python3 \
        py3-setuptools \
        py3-pip \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        libzip-dev \
        oniguruma-dev \
	; \
	\
	docker-php-ext-configure gd; \
	docker-php-ext-install -j "$(nproc)" \
		bcmath \
		exif \
		gd \
		mysqli \
		zip \
        pdo_mysql \
        mbstring \
        pcntl \
        sockets \
	; \
	pecl install redis; \
	docker-php-ext-enable redis; \
	rm -r /tmp/pear; \
	\
	runDeps="$( \
		scanelf --needed --nobanner --format '%n#p' --recursive /usr/local/lib/php/extensions \
			| tr ',' '\n' \
			| sort -u \
			| awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
	)"; \
	apk add --no-network --virtual .wordpress-phpexts-rundeps $runDeps; \
	apk del --no-network .build-deps

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && php composer-setup.php --install-dir=/usr/local/bin --filename=composer

COPY docker/supervisor/default.conf /etc/supervisor/supervisord.conf
COPY docker/fpm/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/php/php.ini-production /usr/local/etc/php/php.ini
RUN mkdir /etc/supervisor/conf.d/
# COPY docker/supervisor/conf/*.conf /etc/supervisor/conf.d/
RUN mkdir /etc/supervisor/logs && touch /etc/supervisor/logs/supervisord.log && mkdir /etc/supervisor/logs/horizon  && chmod -R 777 /etc/supervisor

USER www-data:www-data
COPY --chown=www-data docker/script/entrypoint.sh /home/www-data
RUN chmod -R 755 /home/www-data/entrypoint.sh

WORKDIR /var/www/html
COPY --chown=www-data . /var/www/html
RUN chmod -R 755 /var/www/html/storage && chmod -R 755 /var/www/html/bootstrap

CMD ["/home/www-data/entrypoint.sh"]

USER www-data

EXPOSE 9001
EXPOSE 9000