# syntax=docker/dockerfile:experimental
FROM php:7.4-cli as intermediate

# Install deps
RUN apt-get -y update && apt-get -y install git zip unzip openssh-client

# Install composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer && \
    apt-get -y autoremove && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
RUN git config --system url."ssh://git@github.com/".insteadOf "https://github.com/"
RUN mkdir -p -m 0600 ~/.ssh && \
    ssh-keyscan -t rsa github.com >> ~/.ssh/known_hosts && \
    ssh-keygen -F github.com -l -E sha256 \
        | grep -q "SHA256:nThbg6kXUpJWGl7E1IGOCspRomTxdCARLviKw6E5SY8"
RUN ssh-keyscan github.com >> /root/.ssh/known_hosts

# Copy dependencies
WORKDIR /code/
COPY ./composer.json /code/composer.json
COPY ./composer.lock /code/composer.lock
RUN --mount=type=ssh mkdir -p /var/ssh && \
    GIT_SSH_COMMAND="ssh -o \"ControlMaster auto\" -o \"ControlPersist 300\" -o \"ControlPath /var/ssh/%r@%h:%p\"" \
    composer --no-interaction --ansi --ignore-platform-reqs --no-dev install

FROM php:7.4-alpine

MAINTAINER Luca Santarella <luca@docspera.com>

# Install PHP Extensions
RUN docker-php-ext-install opcache pdo pdo_mysql bcmath

# Install cURL and cURL PHP Extension
RUN apk add --update --no-cache curl
RUN apk add --update --no-cache openssl-dev zlib-dev curl-dev && \
    docker-php-ext-install curl && \
    apk del --no-cache openssl-dev zlib-dev curl-dev

# Set config
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN echo "opcache.enable=1" >>  "$PHP_INI_DIR/php.ini" && \
    echo "opcache.validate_timestamps=0" >>  "$PHP_INI_DIR/php.ini" && \
    echo "opcache.memory_consumption=128" >>  "$PHP_INI_DIR/php.ini" && \
    echo "opcache.enable_cli=1" >> "$PHP_INI_DIR/php.ini"

# Install Spiral
ENV SPIRAL_VERSION=2.5.0
RUN curl -Lo /tmp/spiral-${SPIRAL_VERSION}-linux-amd64.tar.gz https://github.com/spiral/framework/releases/download/v${SPIRAL_VERSION}/spiral-${SPIRAL_VERSION}-linux-amd64.tar.gz && \
    tar zxf /tmp/spiral-${SPIRAL_VERSION}-linux-amd64.tar.gz -C /tmp  && \
    mv /tmp/spiral-${SPIRAL_VERSION}-linux-amd64/spiral /usr/local/bin/spiral && \
    chmod a+x /usr/local/bin/spiral && \
    rm -r /tmp/spiral-${SPIRAL_VERSION}-linux-amd64

# Copy SRC
COPY --from=0 /code/vendor/ /code/vendor
COPY ./ /code/
WORKDIR /code/
ENTRYPOINT ["spiral"]
