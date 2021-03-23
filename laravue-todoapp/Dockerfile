FROM php:7.4.16-cli-buster

RUN apt-get update && apt-get install -y 
      
RUN curl -fsSL https://deb.nodesource.com/setup_15.x | bash - 
RUN apt-get install -y nodejs

WORKDIR /usr/src/myapp/
COPY ../laravue-todoapp ./laravue-todoapp


#RUN ["bin/sh", "./composer-install.sh"]
#RUN ["composer", "install"]
RUN ["npm", "install"]
#CMD ["php", "artisan", "serve"]
CMD ["/bin/bash"]