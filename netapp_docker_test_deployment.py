import requests
import urllib

print ("[*] Testing NetApp API deployment...")
try:
	r = requests.post('http://127.0.0.1:8000/AreaMachines', json={"externalId": "10003@domain.com", "msisdn": "918369110173", "ipv4Addr": "10003@domain.com", "ipv6Addr": "0:0:0:0:0:0:0:1", "notificationDestination": "http://localhost:80/api/v1/utils/monitoring/callback", "monitoringType": "LOCATION_REPORTING", "maximumNumberOfReports": 1, "monitorExpireTime": "2021-10-23T10:29:04.350Z"})
	if (r.status_code == 200):
		print "[+] SUCCESS"
	else:
		print "[-] FAIL"
except:
	print ("[-] FAIL")

print ("[*] Testing NetApp ConfigUI deployment...")

try:
	r2 = urllib.urlopen("http://127.0.0.1:80/configui/").getcode()
	if (r2 == 200):
        	print "[+] SUCCESS"
	else:
        	print "[-] FAIL"
except:
	print ("[-] FAIL")
