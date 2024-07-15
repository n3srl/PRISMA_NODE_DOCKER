import logging
from datetime import datetime
from src.ssh_client import PRISMASSHClient
from src.sql_client import PRISMASQLCLIENT

#Path datetime file log
datetime_path = "X:\\last_scan_completed.cfg"

#Path workspace
path_detections = "/prismadata/detections/single"
path_events = "/prismadata/detections/multiple"
path_calibrations = "/prismadata/calibrations"

#SSH settings
prisma_dashboard_ip = "10.8.0.3"
prisma_dashboard_OS_username = "bianchi"
prisma_dashboard_OS_password = "Cambiami"

#SQL settings
prisma_database_ip = "192.168.1.81"
prisma_database_username = "root"
prisma_database_password = ""
prisma_database_nameDB = "inaf_prisma"


#--------------------------------------------

#Create logger
logger = logging.getLogger(__name__)
logger.setLevel(logging.INFO)
logHandler = logging.StreamHandler()
logger.addHandler(logHandler)

#Initializing global variables
try:
    sshClient1 = PRISMASSHClient(\
        prisma_dashboard_ip, \
        prisma_dashboard_OS_username, \
        prisma_dashboard_OS_password)
    logger.info("SSH Workspace connection successful")
except:
    logger.error("SSH Workspace connection ERROR")
    exit()

try:
    sqlClient1 = PRISMASQLCLIENT(\
        prisma_database_ip, \
        prisma_database_username, \
        prisma_database_password, \
        prisma_database_nameDB)
    logger.info("MySQL Database connection successful")
except:
    logger.error("MySQL Database connection ERROR")
    exit()
