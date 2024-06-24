#!/bin/bash
echo "Starting PRISMA clean disk"

prismadata_path=$1
start_days=$2
percentage=$3

du=0

function compute_du(){
 disk_usage_command="df -h | grep /dev/nvme0n1p2 | awk -F% '{print \$1}'"
 #echo $disk_usage_command
 df_output=`eval $disk_usage_command`
 du=${df_output: -3}
}

if [[ -z $percentage ]]; then
  percentage=80
fi



compute_du

echo "Disk usage: $du%"

if [[ $du -gt $percentage ]]; then
 echo "Disk Usage $du% ecceded $percentage%, removing files of $start_days days ago."

 if [[ -z $start_days ]]; then
  start_days=360
 fi
 if [[ -z  $prismadata_path ]]; then
	echo "usage: $0 /prismadata/<STATION CODE>/ <Start days> <Percentage> eg. /prismadata/ITLO06/ 360 80"
	echo "start days: need to be at least 60"
	exit;
 fi

 for (( days=$start_days; days>=60; days-- ))
 do
  current_date=$(date +%s)
  days_ago=$(($current_date - $days * 86400))
  
  find_command="find $prismadata_path -type f \( ! -name 'default.bmp' \) -exec sh -c '
  file_birth_time=\$(stat -c %W \"\$1\")
  if [ \"\$file_birth_time\" -lt \"$days_ago\" ]; then
    echo \"\$1 is older than $days days\"
  fi
' {} \;"


  echo $find_command
  #eval $find_command 

  compute_du

  if [[ $du -gt $percentage ]]; then
   echo "Disk Usage $du% exceded $percentage, removing files of $days days ago."
  else
   echo "Finished removing files" 
   break
  fi

 done
else
echo "Nothing to do"
fi
