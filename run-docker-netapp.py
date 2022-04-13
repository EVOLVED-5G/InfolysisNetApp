import os
import time
import string

#INFOLYSIS NETAPP DOCKER



print ("\nCreate DOCKER NETAPP")

os.system("docker run --cap-add=NET_ADMIN -itd --name docker-netapp -p 8090:80 -p 8091:8000 docker-netapp")
#os.system("docker run -itd --name docker-netapp -p 6666:80 docker-netapp")

print ("\n\n\n DOCKER NETAPP CONFIGUI: http://185.184.71.39:8090/configui/\n\n\n")
