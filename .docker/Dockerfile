FROM ubuntu:latest

# Set the timezone
ENV TZ=Europe/Sofia
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Update and install necessary packages
RUN apt-get update && apt-get install -y \
    software-properties-common \
    && add-apt-repository ppa:ondrej/php \
    && apt-get update && apt-get install -y \
    php \
    php-cli \
    php-fpm \
    php-mysql \
    php-xml \
    php-mbstring \
    php-curl \
    php-zip \
    php-gd \
    nginx \
    wget \
    cron \
    && apt-get clean && apt-get install mc -y && apt-get install mysql-client -y && apt-get install git -y && apt-get install composer -y

# Copy default nginx config
COPY default /etc/nginx/sites-available/default

COPY ./entrypoint_ubuntu.sh /entrypoint.sh

# Expose port 80 for nginx
EXPOSE 80
