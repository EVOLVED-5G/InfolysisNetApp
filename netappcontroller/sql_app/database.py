from sqlalchemy import create_engine
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.orm import sessionmaker
from urllib.parse import quote

import requests

with open('./sql_app/config.txt') as c:
	lines = c.read().splitlines() 

#DATABASE_URL = 'mysql+pymysql://root:theoni@127.0.0.1:3305/test'
DATABASE_URL = 'mysql+pymysql://'+lines[0]+':%s@127.0.0.1:3306/nettapp_evolved5g' % quote(lines[1])
#DATABASE_URL = 'mysql+pymysql://'+lines[0]+':%s@127.0.0.1:3305/test' % quote(lines[1])
#DATABASE_URL = 'mysql+pymysql://user:password@host/db_name'

engine = create_engine(DATABASE_URL)

SessionLocal = sessionmaker(bind=engine)

Base = declarative_base()
