import os

os.system("nohup /usr/bin/python3.9 -m uvicorn --host 0.0.0.0 sql_app.nac:app --reload &")
