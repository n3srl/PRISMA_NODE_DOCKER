#!/bin/bash
#/home/user/clean_disk.sh /userdata/ITTO12/ 360 80 

data_path=$1
start_days=$2
percentage=$3
du=0

function compute_du()
{
 disk_usage_command="df -h | grep /dev/nvme0n1p2 | awk -F% '{print \$1}'"
 #echo $disk_usage_command
 df_output=`eval $disk_usage_command`
 du=${df_output: -3}
}

echo "Starting clean_disk"

if [[ -z $percentage ]]; then
  percentage=80
fi

compute_du

echo "Disk usage: $du%"

if [[ $du -gt $percentage ]]; then
 echo "Disk Usage $du% ecceded $percentage%, removing files older than $start_days days ago..."

 if [[ -z $start_days ]]; then
  start_days=360
 fi
 if [[ -z  $data_path ]]; then
	echo "usage: $0 /prismadata/<STATION CODE>/ <Start days> <Percentage> eg. /prismadata/ITLO06/ 360 80"
	echo "start days: need to be at least 60"
	exit;
 fi

 find_command="find $data_path -type f \( ! -name 'default.bmp' \) -exec sh -c './process_file.sh' {} $start_days $percentage \;"

 echo $find_command
 #eval $find_command 

else
 echo "Nothing to do"
fi
