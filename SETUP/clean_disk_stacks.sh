#!/bin/bash
#/home/user/clean_disk_stacks.sh /prismadata/ITLO06 360 80

data_path=$1
start_days=$2          # non usato in questa versione ma mantenuto per compatibilità
percentage=$3
stationcode=${data_path##*/}
du=0

if [[ -z $data_path ]]; then
  echo "usage: $0 /prismadata/<STATION CODE>/ <Start days> <Percentage>  es: /prismadata/ITLO06/ 360 80"
  echo "start days: need to be at least 60"
  exit 1
fi

if [[ -z $start_days ]]; then
  start_days=360
fi

if [[ -z $percentage ]]; then
  percentage=80
fi

compute_du() {
  disk_usage_command="df -h | grep /dev/nvme0n1p2 | awk -F% '{print \$1}'"
  df_output=$(eval "$disk_usage_command")
  du=${df_output: -3}
}

compute_du

echo "Starting $0"
echo "Disk usage: $du%"
echo "Station code: $stationcode"

if [[ $du -gt $percentage ]]; then
  echo "Disk Usage $du% exceeded $percentage%, removing 'stacks' data in oldest day folders..."

  # Trova le cartelle giorno nel formato STAZIONE_YYYYMMDD direttamente sotto /STAZIONE/
  # Ordinamento per campo dopo '_' (YYYYMMDD) crescente
  # Versione robusta con NUL delimiter
  while IFS= read -r -d '' dir; do
    # Possibili percorsi 'stacks': direttamente sotto il giorno o dentro 'captures'
    candidates=(
      "$dir/stacks"
      "$dir/captures/stacks"
    )

    cleaned_any=false
    for stackdir in "${candidates[@]}"; do
      if [[ -d "$stackdir" ]]; then
        echo "Found stacks: $stackdir"
        # Elimino l'intera cartella stacks (più semplice e libera più spazio)
        cmd=(rm -rf -- "$stackdir")
        echo "${cmd[@]}"
        "${cmd[@]}"
        cleaned_any=true
      fi
    done

    if [[ "$cleaned_any" == true ]]; then
      compute_du
      echo "Disk usage after cleaning '$dir': $du%"

      if [[ $du -le $percentage ]]; then
        echo "Finished: disk usage now within threshold."
        break
      else
        echo "Still above threshold ($du%), moving to next folder..."
      fi
    else
      echo "No 'stacks' folder found in: $dir (skipping)"
    fi

  done < <(find "$data_path" -mindepth 1 -maxdepth 1 -type d -name "*_*" -print0 \
           | sort -z -t _ -k 2)

else
  echo "Disk usage is within the acceptable range."
fi
