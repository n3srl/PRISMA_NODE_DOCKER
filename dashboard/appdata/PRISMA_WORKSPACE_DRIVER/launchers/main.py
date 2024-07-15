from src.time_manager import (
    need_check,
    need_check_exp,
    write_datet_str,
    datetime_launch_str,
    datetime_launch,
    datetime_last_TOT_scanner_str,
    datetime_last_TOT_scanner,
    calibration_name_to_dt_str
)
from src.settings import (
    sqlClient1,
    sshClient1,
    logger,
    path_detections,
    path_events,
    path_calibrations
)
from scanners.detection import collect_detections
from scanners.event import collect_events
from scanners.calibration import collect_calibration
import time



#Represent a single exectuion of the entire scanner
def complete_scanner(forced_check=False):
    #-----------------------------Init
    logger.info("Starting complete scanner")


    #-----------------------------All collect
    logger.info("Starting collect detections")
    try:
        collect_detections(path_detections, forced_check)
        logger.info("Terminating collect detections")
    except:
        logger.error("ERROR collect detections")

    time.sleep(60)

    logger.info("Starting collect events")
    try:
        collect_events(path_events, forced_check)
        logger.info("Terminating collect events")
    except:
        logger.error("ERROR collect events")

    time.sleep(60)

    logger.info("Starting collect calibrations")
    try:
        collect_calibration(path_calibrations, forced_check)
        logger.info("Terminating collect calibrations")
    except:
        logger.error("ERROR collect calibrations")
    

    #-----------------------------Termination operation
    sshClient1.close()
    write_datet_str(datetime_launch_str)



#Launch scanner
complete_scanner()