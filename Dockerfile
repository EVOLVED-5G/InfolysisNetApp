#FROM linode/lamp
FROM pensiero/apache-php-mysql

RUN apt-get update && apt-get install -y software-properties-common
RUN add-apt-repository ppa:deadsnakes/ppa
RUN apt-get update && apt-get install -y net-tools iputils-ping vim unzip tcpdump bmon mysql-server python3.9 python3.9-distutils python3-setuptools jq
RUN curl https://bootstrap.pypa.io/get-pip.py -o get-pip.py
RUN python3.9 get-pip.py

COPY configui /var/www/html/configui
COPY entrypoint.py /var/www/
COPY entrypoint2.py /var/www/
COPY entrypoint3.py /var/www/
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY netappcontroller /var/www/
COPY netapp_docker_test_deployment.py /var/www/
<<<<<<< HEAD
#ENV NEF_HOSTNAME="http://185.184.71.39:8888"
=======
COPY dummy /var/www/
ENV NEF_HOSTNAME="http://185.184.71.39:8888"
ENV CAPIF_HOSTNAME=capifcore
ENV CAPIF_PORT_HTTP=8080
ENV CAPIF_PORT_HTTPS=443

>>>>>>> 494ce1e5891bdb3c741a2dd112130e07fd5c4f73
#COPY rc.local /etc/
#RUN chmod 755 /etc/rc.local

EXPOSE 80 8000

RUN python /var/www/entrypoint.py
#RUN python /var/www/entrypoint2.py
#RUN python /var/www/entrypoint3.py

CMD python /var/www/entrypoint3.py && tail -f /dev/null

#RUN sh /etc/rc.local

#CMD python /var/www/entrypoint2.py && /bin/bash
#CMD python /var/www/entrypoint2.py
#CMD ["python", "/var/www/entrypoint2.py"]
