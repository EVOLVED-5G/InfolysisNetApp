import os
import time



os.system("echo \"83.212.73.142     capifcore\" >> /etc/hosts")
time.sleep(1)
os.system("service apache2 start")
os.system("echo \"skip-name-resolve\" >> /etc/mysql/mariadb.conf.d/50-server.cnf")
os.system("service mysql restart")

time.sleep(3)

os.system("sh /var/www/capif_certificates/prepare.sh")
time.sleep(2)
print("execution")
os.system("nohup /usr/bin/python3.9 -m uvicorn --host 0.0.0.0 sql_app.nac:app --reload &")
