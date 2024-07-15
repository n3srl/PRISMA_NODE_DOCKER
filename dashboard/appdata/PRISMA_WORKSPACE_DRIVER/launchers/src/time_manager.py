import time
from datetime import datetime
from src.settings import (
    datetime_path,
    logger
)
import os

datetime_launch_str = str(datetime.now()).split('.')[0]
datetime_launch = datetime.fromisoformat(datetime_launch_str)

#write datatime_str to file
def write_datet_str(new_datetime):
    try:
        f = open(datetime_path, "w+")
        f.write(str(new_datetime))
        f.close()
    except:
        logger.error("write_datet_str ERROR with path = "+str(datetime_path))

#read datatime_str from file
def read_datet_str():
    if(os.path.exists(datetime_path)):
        return open(datetime_path, "r").readline()
    else:
        return "1970-01-01 01:01:01"

datetime_last_TOT_scanner_str = read_datet_str()
logger.info("last_scan_completed = "+datetime_last_TOT_scanner_str)
datetime_last_TOT_scanner = datetime.fromisoformat(datetime_last_TOT_scanner_str)

def get_time_str(year, month, day, hours, minutes, seconds):
    try:
        return time.strftime(str(year)+'-'+str(month)+'-'+\
            str(day)+' '+str(hours)+':'+str(minutes)+':'+str(seconds))
    except:
        logger.error("ERROR function get_time_str")

#order of date is relevant
def need_check_exp(str_datetime_last_TOT_scanner, str_datetime_modif_item):
    date_str_datetime_last_TOT_scanner = datetime.fromisoformat(str_datetime_last_TOT_scanner)
    date_str_datetime_modif_item = datetime.fromisoformat(str_datetime_modif_item)
    return date_str_datetime_last_TOT_scanner < date_str_datetime_modif_item

def need_check(str_datetime_modif_item):
    try:
        date_str_datetime_modif_item = datetime.fromisoformat(str_datetime_modif_item)
        return datetime_last_TOT_scanner < date_str_datetime_modif_item
    except:
        logger.error("ERROR function need_check with input ="+str(str_datetime_modif_item))

#input example -> 20180804T032857 or 20180804032857
def freeture_time_to_dt_str(str_freeture_time):
    try:
        date_time_obj = datetime.strptime(str_freeture_time, '%Y%m%dT%H%M%S')
        return str(date_time_obj)
    except:
        try:
            date_time_obj = datetime.strptime(str_freeture_time, '%Y%m%d%H%M%S')
            return str(date_time_obj)
        except:
            logger.error("Error freeture_time_to_dt_str with input "+str(str_freeture_time))

def is_month_calib(str_calib_name):
    try:
        date = str(str_calib_name).split("_")[1]
        if(len(date) == 6):
            return 1
        else:
            return 0
    except:
        logger.error("Error is_month_calib with input = "+str(str_calib_name))

def calibration_name_to_dt_str(str_calibration_name):
    date = str_calibration_name.split("_")[1]
    if(len(date) == 6):
        return datetime.strptime(date, '%Y%m')
    else:
        return datetime.strptime(date, '%Y%m%d')

def calibration_month_to_d_str(month):
    return datetime.strptime(month, '%Y%m')