import os

os.system("service apache2 start")
os.system("service mysql start");
os.system("sh /var/www/arxi.sh")

#os.system("nohup /usr/bin/python3.9 -m uvicorn --host 0.0.0.0 sql_app.nac:app --reload &")
