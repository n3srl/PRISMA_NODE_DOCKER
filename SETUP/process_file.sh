 #!/bin/bash
 du=0
 
 file_path=$1
 start_days=$2
 percentage=$3

 current_date=$(date +%s)
 
 function compute_du()
 {
  disk_usage_command="df -h | grep /dev/nvme0n1p2 | awk -F% '{print \$1}'"
  #echo $disk_usage_command
  df_output=`eval $disk_usage_command`
  du=${df_output: -3}
 }

 echo "Start Days: $1"
 echo "Processing file: $2"
 echo "Disk usage: $du%"


 for (( days=$start_days; days>=60; days-- ))
 do
  days_ago=$(($current_date - $days * 86400))
  file_birth_time=$(stat -c %W "$file_path")
  
  if [ "$file_birth_time" -lt "$days_ago" ]; then
	echo "$file_path is older than $days days"
  fi
    
  compute_du

  if [[ $du -gt $percentage ]]; then
   echo "Disk Usage $du% exceded $percentage%, removing files older than $days days ago."
  else
   echo "Finished removing files" 
   break
  fi
done