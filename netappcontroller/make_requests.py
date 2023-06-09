import requests
import json
from requests.structures import CaseInsensitiveDict


'''response = requests.get("http://127.0.0.1:8000/worker")
#print(response.json())

response = requests.post("http://127.0.0.1:8000/worker", data = {'FirstName': 'Maria', 'LastName':'Tsitsi'})

print(response.json())'''

def get_workers():
	response = requests.get("http://127.0.0.1:8000/worker/allworkers")
	return response.json()

def get_worker_by_id(worker_id: str):
	URL = "http://127.0.0.1:8000/worker/"+worker_id
	response = requests.get(url = URL)
	return response.json()

def insert_worker(FirstName: str, LastName: str):
	data = {"FirstName": FirstName, "LastName": LastName}
	#print(data)
	#data = schemas.WorkerIn(data)
	response = requests.post("http://127.0.0.1:8000/worker/insert/", data = json.dumps(data))
	return response.json()

def update_worker(id: int, FirstName: str, LastName: str):
	data = {"id": id, "FirstName": FirstName, "LastName": LastName}
	response = requests.post("http://127.0.0.1:8000/worker/update/", data = json.dumps(data))
	return response.json()


'''print("Workers' list: ")
print(get_workers())
print("Worker with id = 1: ")
print(get_worker_by_id('1'))
print("Inserting worker with FirstName: Anastasia and LastName: Mavrogianni ...")
print(insert_worker("Anastasia", "Mavrogianni"))
print("DONE!!!")
print("Updating worker with id = 5")
print("Name before updating : ")
print(get_worker_by_id('5'))
print("New values: Theoni->Theoni, BliBli->Bla")
print(update_worker(5, "Theoni", "Bla"))
print("DONE!!!")'''


def get_auth_token(username: str, password: str):
	url = "http://185.184.71.39:8888/api/v1/login/access-token"
	data = {"username": username, "password": password}
	response = requests.post(url, data=data)
	return response.json()

def get_cell(user_id: str):
	url = "http://185.184.71.39:8888/api/v1/3gpp-monitoring-event/v1/myNetapp/subscriptions"
	data = {"externalId": "123456789@domain.com", 
	"msisdn": "918369110173",
	"ipv4Addr": user_id,
	"ipv6Addr": "0:0:0:0:0:0:0:1",
	"notificationDestination": "http://localhost:80/api/v1/utils/monitoring/callback",
	"monitoringType": "LOCATION_REPORTING",
	"maximumNumberOfReports": 1,
	"monitorExpireTime": "2021-10-22T10:17:25.947Z"}

	with open('token_credentials.txt') as f:
		lines = f.read().splitlines()

	username = lines[0]
	password = lines[1]

	token_string = get_auth_token(username, password)
	
	token = lines[0]
	headers = CaseInsensitiveDict()
	headers["Authorization"] = token_string["token_type"] + ' ' + token_string["access_token"]

	response = requests.post(url, data=json.dumps(data), headers=headers)
	return response.json()



#print(token_string['token_type'])
print(get_cell('10.0.0.3'))

