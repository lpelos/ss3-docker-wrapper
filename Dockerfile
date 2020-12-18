FROM tutum/lamp:latest

# Install SO dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
      curl \
      nodejs npm \
      php5-curl php5-gd php5-tidy

# Install Composer
RUN mkdir /root/.composer && \
  cd /root/.composer && \
  curl -sS https://getcomposer.org/installer | php

# Bower fix: create node symbolic link
RUN ln -s `which nodejs` /usr/bin/node

ENV APACHE_CONFDIR /etc/apache2
ENV APACHE_ENVVARS $APACHE_CONFDIR/envvars

RUN set -ex \
	\
# generically convert lines like
#   export APACHE_RUN_USER=www-data
# into
#   : ${APACHE_RUN_USER:=www-data}
#   export APACHE_RUN_USER
# so that they can be overridden at runtime ("-e APACHE_RUN_USER=...")
	&& sed -ri 's/^export ([^=]+)=(.*)$/: ${\1:=\2}\nexport \1/' "$APACHE_ENVVARS" \
	\
# setup directories and permissions
	&& . "$APACHE_ENVVARS" \
	&& for dir in \
		"$APACHE_LOCK_DIR" \
		"$APACHE_RUN_DIR" \
		"$APACHE_LOG_DIR" \
		/var/www/html \
	; do \
		rm -rvf "$dir" \
		&& mkdir -p "$dir" \
		&& chown -R "$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$dir"; \
	done

# Copy custom configuration files
COPY config/apache.conf /etc/apache2/sites-available/app.conf
COPY config/php.ini /etc/php5/apache2/php.ini
COPY config/_ss_environment.php /var/www

# Enable custom Apache virtual host
RUN a2dissite 000-default.conf && a2ensite app.conf

# Create app volume
VOLUME /var/www/app

WORKDIR /var/www/app
EXPOSE 80 3306
