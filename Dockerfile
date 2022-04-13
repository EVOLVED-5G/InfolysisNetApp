#FROM linode/lamp
FROM pensiero/apache-php-mysql

RUN apt-get update && apt-get install -y software-properties-common
RUN add-apt-repository ppa:deadsnakes/ppa
RUN apt-get update && apt-get install -y net-tools iputils-ping vim unzip tcpdump bmon mysql-server python3.9 python3.9-distutils python3-setuptools
RUN curl https://bootstrap.pypa.io/get-pip.py -o get-pip.py
RUN python3.9 get-pip.py

COPY configui /var/www/html/configui
COPY entrypoint.py /var/www/
COPY entrypoint2.py /var/www/
COPY entrypoint3.py /var/www/
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY netappcontroller /var/www/

EXPOSE 80 8000

RUN python /var/www/entrypoint.py
CMD python /var/www/entrypoint2.py && /bin/bash

