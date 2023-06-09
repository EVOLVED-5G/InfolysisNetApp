import os


os.system("echo \"83.212.73.142     capifcore\" >> /etc/hosts")
os.system("service apache2 start")
os.system("service mysql start")
os.system("sh /var/www/arxi.sh")
os.system("sh /var/www/capif_certificates/prepare.sh")

#os.system("sh /var/www/arxi.sh")

