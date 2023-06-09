#from typing import List, Optional

from pydantic import BaseModel

class WorkerIn(BaseModel):
    FirstName: str
    LastName: str


class WorkerUpdate(BaseModel):
	id: int 
	FirstName: str
	LastName: str


class Worker(BaseModel):
    id: int
    FirstName: str
    LastName: str 

    class Config:
        orm_mode = True

'''class LocationInfo(BaseModel):
    cellId: str
    gNBId: str

class MonitoringEvent(BaseModel):
    monitoringType: str
    locationInfo: LocationInfo


# expected input for post request about retrieving cell id
class MonitoringEventIn(BaseModel):
    externalId: str
    notificationDestination: str
    monitoringType: str
    maximumNumberOfReports: int
    monitorExpireTime: str

    class Config:
        schema_extra = {
            "example": {
              "externalId": "123456789@domain.com",
              "notificationDestination": "http://localhost:80/api/v1/utils/monitoring/callback",
              "monitoringType": "LOCATION_REPORTING",
              "maximumNumberOfReports": 1,
              "monitorExpireTime": "2021-11-19T12:34:30.333Z"
            }
        }'''


class LocationIn(BaseModel):
    externalId: str

    class Config:
        schema_extra = {
            "example": {
                "externalId": "123456789@domain.com"
            }
        }

class LocationInfo2(BaseModel):
    cell_id: str
    enode_b_id: None


class Location(BaseModel):
    external_id: str
    ipv4_addr: str
    location_info: LocationInfo2
    monitoring_type: str



class AreaMachines(BaseModel):
    id: int
    name: str
    area: int
    status : int
    active: int

    class Config:
        orm_mode=True

class MachineFiles(BaseModel):
    id: int
    name: str
    link: str
    machine_id: int
    active: int

    class Config:
        orm_mode=True
