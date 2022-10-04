import os
import time

time.sleep(1)
os.system("service apache2 start")
os.system("service mysql start")
time.sleep(3)
print("execution")
os.system("nohup /usr/bin/python3.9 -m uvicorn --host 0.0.0.0 sql_app.nac:app --reload &")
