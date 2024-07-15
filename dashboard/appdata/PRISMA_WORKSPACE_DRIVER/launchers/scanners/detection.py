from src.time_manager import (
    need_check,
    need_check_exp,
    write_datet_str,
    datetime_launch_str,
    datetime_launch,
    datetime_last_TOT_scanner_str,
    datetime_last_TOT_scanner,
    freeture_time_to_dt_str
)
from src.settings import (
    sqlClient1,
    sshClient1,
    logger
)

def collect_detections(base_path, forced_check=False):
    for station in sshClient1.list_from_directory_formatted(base_path):
        for month in sshClient1.list_from_directory_formatted(base_path+"/"+str(station)):
            need_check_month = need_check(\
                sshClient1.modifiedStat_from_directory(base_path+"/"+str(station)+"/"+str(month)))
            #print("need_check_month="+str(need_check_month)+"__"+str(station)+"/"+str(month))#debug
            if(need_check_month or forced_check):
                element_folders_list = \
                    sshClient1.list_from_directory_formatted(base_path+"/"+str(station)+"/"+str(month))
                if(len(element_folders_list) != 0):
                    list_values = []
                    for element_name in element_folders_list:
                        #print(element_name)#debug
                        single_insert = "('"+str(element_name)+"', '"+str(station)+"', '"+base_path+"/"+str(station)+"/"+str(month)+"/"+str(element_name)+"', '"+freeture_time_to_dt_str(element_name.split("_")[1])+"')"
                        list_values.append(single_insert)
                    try:
                        #print("exec !empty query for detect/MM/Code_node -- "+str(month)+"/"+station)#debug
                        query = sqlClient1.build_multiple_insert_query(\
                            "(`name`, `node_code`, `abs_path`, `datetime`)",\
                            "pr_drv_detection", list_values)
                        sqlClient1.replace_query(query)
                    except:
                        logger.error("ERROR query for month/station -- "+str(month)+"/"+station)