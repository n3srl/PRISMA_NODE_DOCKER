#!/bin/bash
echo "Starting PRISMA clean disk"

prismadata_path=$1
start_days=$2
percentage=$3

du=0

function du(){
 disk_usage_command="df -h | grep /dev/nvme0n1p2 | awk -F% '{print \$1}'"
 #echo $disk_usage_command
 df_output=`eval $disk_usage_command`
 du=${df_output: -3}
}

if [[ -z $percentage ]]; then
  percentage=80
fi



du

echo "Disk usage: $du%"

if [[ $du -gt $percentage ]]; then
 echo "Disk Usage $du% ecceded $percentage%, removing files of $start_days days ago."

 if [[ -z $start_days ]]; then
  start_days=360
 fi
 if [[ -z  $prismadata_path ]]; then
	echo "usage: $0 /prismadata/<STATION CODE>/ <Start days> <Percentage> eg. /prismadata/ITLO06/ 360 80"
	exit;
 fi

 for (( day=$start_days; day>=60; day-- ))
 do
  find_command="find $prismadata_path -type f -ctime +$day -exec rm -f {} \;"
  echo $find_command
  eval $find_command 

  du

  if [[ $du -gt $percentage ]]; then
   echo "Disk Usage $du% exceded $percentage, removing files of $day days ago."
  else
   echo "Finished removing files" 
   break
  fi

 done
else
echo "Nothing to do"
fi
