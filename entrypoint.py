import os
import time

#os.system("nohup python /home/client.py &")

os.system("service apache2 start")
os.system("service mysql start");
os.system("mysql < /var/www/html/configui/nettapp_evolved5g.sql");
#os.system("mysql -e \"insert into admins values (2,'admin2','315f166c5aca63a157f7d41007675cb44a948b33','admin','','1',null)\"");
os.system("mysql -e \"ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'root'\"");
os.system("pip3.9 install uvicorn")
os.system("pip3.9 install fastapi==0.70.0")
os.system("pip3.9 install sqlalchemy==1.4")
os.system("pip3.9 install pymysql")
os.system("pip3.9 install --upgrade requests==2.20.1")
os.system("pip3.9 install fastapi")
os.system("pip3.9 install --upgrade setuptools")
os.system("pip3.9 install --upgrade evolved5g")
os.system("pip3.9 install typing-extensions==3.10.0.2")
os.system("pip3.9 install pydantic==1.8.2")

#os.system("sh /var/www/arxi.sh")
