FROM registry.univ-lr.fr:80/iutlr-info/iutlr-info-apache2-php7.4-symfony4

MAINTAINER Jamal Malki <jmalki@univ-lr.fr>
LABEL Vendor="Jamal Malki"
LABEL Description="Apache2-Symfony4-PHP7.4"
LABEL Version="mars-2020"

####### vhosts activation 
ADD vhosts /etc/apache2/sites-available
RUN rm /etc/apache2/sites-enabled/000-default.conf

####### add activation 
RUN a2ensite appmodule

####### service apache2 start
#CMD /usr/sbin/apache2ctl -D FOREGROUND
