from sqlalchemy.orm import Session
import requests
from requests.structures import CaseInsensitiveDict
import json

from . import models, schemas, emulator_utils

from evolved5g.sdk import LocationSubscriber


def get_worker_by_id(db: Session, worker_id: int):
	return db.query(models.Worker).filter(models.Worker.id == worker_id).first() #first is used for choosing the first row of the returned table. We could use get() instead.


def get_workers(db: Session):
	return db.query(models.Worker).all()


def create_worker(db: Session, worker: schemas.WorkerIn):
	db_worker = models.Worker(FirstName=worker.FirstName, LastName=worker.LastName)
	db.add(db_worker)
	db.commit()
	db.refresh(db_worker)
	return db_worker


def update_worker(db: Session, worker: schemas.WorkerUpdate):
	#db_worker = models.Worker(FirstName=worker.FirstName, LastName=worker.LastName)
	db_worker = db.query(models.Worker).filter(models.Worker.id == worker.id).first()
	db_worker.FirstName = worker.FirstName
	db_worker.LastName = worker.LastName
	db.add(db_worker)
	db.commit()
	db.refresh(db_worker)
	return db_worker


'''def get_auth_token(username: str, password: str):
	url = "http://185.184.71.39:8888/api/v1/login/access-token"
	data = {"username": username, "password": password}
	response = requests.post(url, data=data)
	return response.json()


# this makes a post request to 5G API
def get_cell_by_id(data: schemas.MonitoringEventIn):

	url = "http://185.184.71.39:8888/api/v1/3gpp-monitoring-event/v1/myNetapp/subscriptions"
	
	data = {"externalId": data.externalId, 
	"notificationDestination": data.notificationDestination,
	"monitoringType": data.monitoringType,
	"maximumNumberOfReports": data.maximumNumberOfReports,
	"monitorExpireTime": data.monitorExpireTime}

	with open('token_credentials.txt', 'r') as f:
		lines = f.read().splitlines()

	username = lines[0]
	password = lines[1]

	token_string = get_auth_token(username, password)
	
	token = lines[0]
	headers = CaseInsensitiveDict()
	headers["Authorization"] = token_string["token_type"] + ' ' + token_string["access_token"]

	response = requests.post(url, data=json.dumps(data), headers=headers)
	response = response.json()

	return response'''


# the following function is to replace get_cell_by_id
def get_location(data: schemas.LocationIn):

    netapp_id = "myNetapp"
    host = emulator_utils.get_host_of_the_nef_emulator()
    token = emulator_utils.get_token()
    location_subscriber = LocationSubscriber(host, token.access_token,emulator_utils.get_folder_path_for_certificated_and_capif_api_key(),emulator_utils.get_capif_host(),emulator_utils.get_capif_https_port())

    external_id = data.externalId
    #print ("WORKER ID IS:" + external_id)
    #external_id='10003@domain.com'
    location_info = location_subscriber.get_location_information(
        netapp_id=netapp_id,
        external_id=external_id
    )

    #print(location_info.location_info.cell_id)

    return location_info

def convert_to_Location_schema(location_info):
	location_dict = {"cell_id": location_info.location_info.cell_id, "enode_b_id": location_info.location_info.enode_b_id}
	data = {"external_id": location_info.external_id,
	    	"ipv4_addr": location_info.ipv4_addr,
	    	"location_info": location_dict,
	    	"monitoring_type": location_info.monitoring_type}

	return data



def get_machines_by_cell(db: Session, data):
	cell_id = data.location_info.cell_id
	cell_number = int(cell_id[-1])
	#print(cell_number)
	machines_under_area = db.query(models.Machines.id, models.Machines.name, models.Machines.area, models.Machines.status, models.Machines.active).filter((models.Machines.area == cell_number) & (models.Machines.status == 3)).all()
	#print(machines_under_area.parse_obj)
	return machines_under_area


def get_files_by_machineId(db: Session, machine_id: int):
	files = db.query(models.Files.id, models.Files.name, models.Files.link, models.Files.machine_id, models.Files.active).filter(models.Files.machine_id == machine_id).all()
	return files
