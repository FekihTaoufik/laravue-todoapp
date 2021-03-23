FROM php:7.4.16-cli-buster

# Updating apt package manager
RUN apt-get update && apt-get install -y 

# Installing Node JS      
RUN curl -fsSL https://deb.nodesource.com/setup_15.x | bash - 
RUN apt-get install -y nodejs


# Installing Git
RUN apt-get install -y git

WORKDIR /usr/src/myapp/
COPY ./laravue-todoapp ./laravue-todoapp

WORKDIR /usr/src/myapp/laravue-todoapp
# Installing PHP Compose
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php 
RUN php composer-setup.php 
RUN mv composer.phar /usr/local/bin/composer

RUN ["/usr/local/bin/composer", "install"]
RUN ["npm", "install"]
RUN ["php", "artisan", "key:generate"]
#RUN ["php", "artisan", "migrate"]
RUN ["php", "artisan", "jwt:secret"]

#RUN ["npm", "run", "dev"]

CMD ["php", "artisan", "serve"]
