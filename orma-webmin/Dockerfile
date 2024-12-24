FROM php:7.4.26-apache

#For Orma standard:
# add htaccess rewrite support
# add gettext support
RUN a2enmod rewrite
RUN apt-get -y update 
RUN apt-get -y install --no-install-recommends \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev
		
RUN docker-php-ext-configure gettext
RUN docker-php-ext-install -j$(nproc) gettext


RUN apt-get install -y locales

RUN rm /etc/locale.gen
RUN touch /etc/locale.gen
RUN echo "en_US" >> /etc/locale.gen
RUN echo "it_IT" >> /etc/locale.gen
RUN echo "de_DE" >> /etc/locale.gen
RUN echo "pt_PT" >> /etc/locale.gen
RUN echo "el_GR" >> /etc/locale.gen
RUN echo "fr_FR" >> /etc/locale.gen
RUN echo "it_IT ISO-8859-1" >> /etc/locale.gen
RUN echo "en_US ISO-8859-1" >> /etc/locale.gen
RUN echo "de_DE ISO-8859-1" >> /etc/locale.gen
RUN echo "pt_PT ISO-8859-1" >> /etc/locale.gen
RUN echo "el_GR ISO_8859_7" >> /etc/locale.gen
RUN echo "fr_FR ISO-8859-1" >> /etc/locale.gen
RUN locale-gen

#For Orma Inaf:
# add ssh2 library
RUN apt-get install --no-install-recommends -y libssh2-1-dev
RUN pecl install ssh2-1.3.1
RUN docker-php-ext-enable ssh2
RUN apt-get -y install 	fitspng \
						zip \
						ffmpeg \
						imagemagick \
						git

RUN git clone https://github.com/n3srl/PRISMA_NODE_WEBMIN.git /var/www/html

