#FROM linode/lamp
FROM pensiero/apache-php-mysql

RUN apt-get update && apt-get install -y software-properties-common
#RUN add-apt-repository ppa:deadsnakes/ppa
RUN apt-get update && apt-get install -y net-tools iputils-ping vim unzip tcpdump bmon mariadb-server python3.8 python3.8-distutils python3-setuptools jq
RUN curl https://bootstrap.pypa.io/get-pip.py -o get-pip.py
RUN python3.8 get-pip.py



COPY configui /var/www/html/configui
COPY entrypoint.py /var/www/
COPY entrypoint2.py /var/www/
COPY entrypoint3.py /var/www/
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY netappcontroller /var/www/
COPY netapp_docker_test_deployment.py /var/www/
COPY dummy /var/www/
ENV NEF_HOSTNAME="http://185.184.71.39:8888"
ENV CAPIF_HOSTNAME=capifcore
ENV CAPIF_PORT_HTTP=8080
ENV CAPIF_PORT_HTTPS=443
ENV ENVIRONMENT_MODE=production


EXPOSE 80 8000

RUN python /var/www/entrypoint.py

CMD python /var/www/entrypoint3.py && tail -f /dev/null
#CMD tail -f /dev/null
