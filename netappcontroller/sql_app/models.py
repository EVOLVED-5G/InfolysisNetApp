from sqlalchemy import Column, Integer, String
#from sqlalchemy import Boolean, Column, ForeignKey, Integer, String
#from sqlalchemy.orm import relationship

from .database import Base

class Worker(Base):
    __tablename__ = "worker"
    id = Column(Integer, primary_key=True)
    FirstName = Column(String(16), index=True)
    LastName = Column(String(16), index=True)

class Machines(Base):
    __tablename__='machines'
    id = Column(Integer, primary_key=True)
    name = Column(String(16), index=True)
    area = Column(Integer)
    status = Column(Integer)
    active = Column(Integer)

class Files(Base):
    __tablename__ = "files"
    id = Column(Integer, primary_key=True)
    name = Column(String(16), index=True)
    link = Column(String(16), index=True)
    machine_id = Column(Integer)
    access = Column(String(16), index=True)
    active = Column(Integer)
