## Python Version
* 3.10

## Installed Packages
```
pip install uvicorn[all]
pip install fastapi
pip install sqlalchemy
pip install pymysql
pip install cryptography
```
## Κλήση στο 5GAPI
Για να μπορεί να γίνει η κλήση στο 5G API χρειάζεται ένα txt αρχείο με το όνομα token_credentials.txt στον φάκελο ```netappcontroller/sql_app/``` που να έχει σαν πρώτη γραμμή το user_id και σαν δεύτερη το password που χρησιμοποιούνται για το authorization στον emulator.

*Για να τρέξει και το ```/netappcontroller/make_requests.py``` το ίδιο αρχείο πρέπει να προστεθεί και στον φάκελο ```netappcontroller/```*

## Πρόσβαση στην βάση 
Για να μπορεί να γίνει η πρόσβαση στην βάση χρειάζεται ένα txt αρχείο με το όνομα config.txt στον φάκελο ```netappcontroller/sql_app/ ``` που να έχει σαν πρώτη γραμμή το user και σαν δεύτερη το password (βλ. σχόλιο στο /netappcontroller/sql_app/database.py).
