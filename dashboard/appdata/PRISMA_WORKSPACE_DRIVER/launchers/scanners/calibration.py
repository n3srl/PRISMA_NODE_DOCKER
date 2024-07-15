from src.time_manager import (
    need_check,
    need_check_exp,
    write_datet_str,
    datetime_launch_str,
    datetime_launch,
    datetime_last_TOT_scanner_str,
    datetime_last_TOT_scanner,
    freeture_time_to_dt_str,
    is_month_calib,
    calibration_name_to_dt_str,
    calibration_month_to_d_str
)
from src.settings import (
    sqlClient1,
    sshClient1,
    logger
)

import glob
import os


def report_counter(calibration_path):
    astro_report_counter = 0
    photo_report_counter = 0

    # if any("astro_report" in elem.decode('utf-8') for elem in sshClient1.list_from_directory_formatted(calibration_path)):
    #     astro_report_counter += 1

    for file in sshClient1.list_from_directory_formatted(calibration_path):
        #print(file)
        if (file.endswith('pdf')):
            if 'astro_report' in file:
                astro_report_counter += 1
            if 'photo_report' in file:
                photo_report_counter += 1
    
    #print("astro report" + str(astro_report_counter))
    #print("photo report" + str(photo_report_counter))
    if(astro_report_counter < photo_report_counter):
        return astro_report_counter

    return photo_report_counter


def collect_calibration(base_path, forced_check=False):
    for station in sshClient1.list_from_directory_formatted(base_path):
        monthly_calibration_values = []
        print(station)
        
        for month in sshClient1.list_from_directory_formatted(base_path+"/"+str(station)):
            print(month)
            total_report = report_counter(base_path + "/" + str(station) + "/" + str(month))
            #print("report to show " + str(total_report))
            #print("entrato qui")
            month_single_insert = "('"+ str(station) + "_" + str(month) +"', '" + str(station)+"', '" + str(calibration_month_to_d_str(month))+ "', '" + str(total_report) + "')"
            #print(month_single_insert)
            #print(month_single_insert)
            monthly_calibration_values.append(month_single_insert)
            

        insert_monthly_calibration(monthly_calibration_values)
        for month in sshClient1.list_from_directory_formatted(base_path+"/"+str(station)):
            need_check_month = need_check(
                sshClient1.modifiedStat_from_directory(base_path+"/"+str(station)+"/"+str(month)))
            #print("need_check_month="+str(need_check_month)+"__"+str(station)+"/"+str(month))#debug

            if (need_check_month or forced_check):
                #print("sto qui")
                #print(monthly_calibration_values)
                element_folders_list = \
                    sshClient1.list_from_directory_formatted(
                        base_path+"/"+str(station)+"/"+str(month))
                if (len(element_folders_list) != 0):
                    daily_calibration_values = []
                    for element_name in element_folders_list:
                        #print(element_name)#debug
                        if(element_name.startswith("calibrate")):
                            continue
                        is_month = is_month_calib(element_name)
                        single_insert = "('"+str(element_name)+"', '"+str(station)+"', '"+base_path+"/"+str(station)+"/"+str(
                            month)+"/"+str(element_name)+"', '"+str(calibration_name_to_dt_str(element_name))+"', '"+str(is_month)+"', '" + str(station) + "_" + str(month) + "')"
                        #print(single_insert)
                        daily_calibration_values.append(single_insert)
                    try:
                        # print("exec !empty query for calibration/MM/Code_node -- "+str(month)+"/"+station)#debug
                        query = sqlClient1.build_multiple_insert_query(
                            "(`name`, `node_code`, `abs_path`, `date`, `is_month`, `monthly_calibration`)",
                            "pr_drv_calibration", daily_calibration_values)
                        #print(daily_calibration_values)
                        print("inserisco i files")
                        sqlClient1.replace_query(query)
                    except:
                        logger.error(
                            "ERROR query for month/station -- "+str(month)+"/"+str(station))   
                    


def insert_monthly_calibration(values):

    try:
        #print(monthly_calibration_values)
        query = sqlClient1.build_multiple_insert_query(
            "(`name`, `node_code`, `datetime`, `report_count`)",
            "pr_drv_monthly_calibration", values)
        #print(values)
        #print("sto per inserire i mesi")
        print("inserisco i mesi")
        sqlClient1.replace_query(query)
    except:
        logger.error(
            "ERROR inserting a monthly calibration")