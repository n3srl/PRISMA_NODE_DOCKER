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
from collections import defaultdict

def collect_events(base_path, forced_check=False):
    for month in sshClient1.list_from_directory_formatted(base_path):
        need_check_month = need_check(\
            sshClient1.modifiedStat_from_directory(base_path+"/"+str(month)))
        #print("need_check_month="+str(need_check_month)+"__"+str(station)+"/"+str(month))#debug
        if(need_check_month or forced_check):
            element_folders_list = \
                sshClient1.list_from_directory_formatted(base_path+"/"+str(month))
            if(len(element_folders_list) != 0):

                #---Upload events entry
                list_values = []
                for element_name in element_folders_list:
                    #print(element_name)#debug
                    single_insert = "('"+str(element_name)+"', '"+str(base_path)+"/"+str(month)+"/"+str(element_name)+"', '"+str(freeture_time_to_dt_str(element_name.split("_")[0]))+"', '"+str(0)+"')"
                    list_values.append(single_insert)
                try:
                    #print("exec !empty query for events/MM -- "+str(month))#debug
                    query = sqlClient1.build_multiple_insert_query(\
                        "(`name`, `abs_path`, `datetime`, `is_processed`)",\
                        "pr_drv_event", list_values)
                    sqlClient1.replace_query(query)
                except:
                    logger.error("ERROR query for events month -- "+str(month))
                
                #---Upload joins events-nodes
                array_node = sqlClient1.select_query("SELECT pr_node.nickname, pr_node.code FROM pr_node")
                d = defaultdict(str)
                for k, v in array_node:
                    d[k] = (v)
                list_joins = []
                for event in element_folders_list:
                    for node_partecip in sshClient1.list_from_directory_formatted(base_path+"/"+str(month)+"/"+event):
                        nome_node_partecip = node_partecip.split("_")[0]
                        node_code = d[nome_node_partecip]
                        if(node_code != ""):
                            single_insert = "('"+str(event)+"', '"+str(node_code)+"')"
                            list_joins.append(single_insert)
                try:
                    query = sqlClient1.build_multiple_insert_query(\
                        "(`event_name`, `node_code`)",\
                        "pr_drv_related", list_joins)
                    sqlClient1.replace_query(query)
                    #print("exec !empty query for events-join/MM -- "+str(month))#debug
                except:
                    logger.error("ERROR query for events-codes joins month -- "+str(month))