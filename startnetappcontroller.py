import os

os.system("nohup uvicorn --host 0.0.0.0 sql_app.nac:app --reload &")
