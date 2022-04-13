from typing import List

from fastapi import Depends, FastAPI, HTTPException
from sqlalchemy.orm import Session

from . import crud, models, schemas
from .database import SessionLocal, engine

import requests
import json

from evolved5g.swagger_client.models.monitoring_event_report import MonitoringEventReport

models.Base.metadata.create_all(bind=engine)

app = FastAPI()

# Dependency
def get_db():
    db = SessionLocal()
    try:
        yield db
    finally:
        db.close()

'''@app.post("/worker/insert/", response_model=schemas.Worker)
def create_user(worker: schemas.WorkerIn, db: Session = Depends(get_db)):
	#db_worker = crud.create_worker(db, FirstName=worker.FirstName, LastName=worker.LastName)
	return crud.create_worker(db=db, worker=worker)

@app.get("/worker/allworkers/", response_model=List[schemas.Worker])
def read_workers(db: Session = Depends(get_db)):
	workers = crud.get_workers(db)
	return workers

@app.get("/worker/{worker_id}/", response_model=schemas.Worker)
def read_worker(worker_id: int, db: Session = Depends(get_db)):
	db_worker = crud.get_worker_by_id(db, worker_id=worker_id)
	return db_worker

@app.post("/worker/update/", response_model=schemas.Worker)
def update_worker(worker: schemas.WorkerUpdate, db: Session = Depends(get_db)):
	db_worker = crud.update_worker(db, worker=worker)
	return db_worker'''

'''# returns the same as the Monitoring event post request
@app.post("/WorkerCell/", response_model=schemas.MonitoringEvent)
def find_cell(data: schemas.MonitoringEventIn):
	cell_info = crud.get_cell_by_id(data=data)
	return cell_info'''

@app.post("/WorkerCell/", response_model=schemas.Location)
def find_cell(data: schemas.LocationIn):
	location_info = crud.get_location(data)
	cell_info = crud.convert_to_Location_schema(location_info)
	return cell_info

'''@app.post("/AreaMachines/", response_model=List[schemas.AreaMachines])
def find_area_and_machines(data: schemas.MonitoringEventIn, db: Session = Depends(get_db)):
	cell_info = crud.get_cell_by_id(data=data)
	cell_machines = crud.get_machines_by_cell(db, cell_info)
	return cell_machines'''

@app.post("/AreaMachines/", response_model=List[schemas.AreaMachines])
def find_area_and_machines(data: schemas.LocationIn, db: Session = Depends(get_db)):
	print("AREAMACHINES INIT")
	print(data)
	print ("end areamachines call")
	cell_info = crud.get_location(data=data)
	cell_machines = crud.get_machines_by_cell(db, cell_info)
	return cell_machines

@app.post("/MachineFiles/", response_model=List[schemas.MachineFiles])
def find_files_for_machine(machine_id: int, db: Session = Depends(get_db)):
	machine_files = crud.get_files_by_machineId(db, machine_id)
	return machine_files
