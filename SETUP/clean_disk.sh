#!/bin/bash
#/home/user/clean_disk.sh /userdata/ITTO12 360 80 

data_path=$1
start_days=$2
percentage=$3
stationcode=${data_path##*/}
du=0

if [[ -z  $data_path ]]; then
	echo "usage: $0 /prismadata/<STATION CODE>/ <Start days> <Percentage> eg. /prismadata/ITLO06/ 360 80"
	echo "start days: need to be at least 60"
	exit;
fi

if [[ -z $start_days ]]; then
  start_days=360
fi
 
if [[ -z $percentage ]]; then
  percentage=80
fi


function compute_du()
{
 disk_usage_command="df -h | grep /dev/nvme0n1p2 | awk -F% '{print \$1}'"
 #echo $disk_usage_command
 df_output=`eval $disk_usage_command`
 du=${df_output: -3}
}

compute_du
 
echo "Starting $0"
echo "Disk usage: $du%"
echo "Station code: $stationcode"

if [[ $du -gt $percentage ]]; then
 echo "Disk Usage $du% ecceded $percentage%, removing files older than $start_days days ago..."

 directories=$(find "$data_path" -mindepth 1 -maxdepth 1 -type d -name "${stationcode}_*" | sort -t_ -k2)
 if [[ -z $directories ]]; then
  echo "Nothing to do"
 else
  for dir in $directories; do
   command="rm -f $dir"
   echo $command
   #eval $command 
  done
 fi
else
    echo "Disk usage is within the acceptable range."
fi
