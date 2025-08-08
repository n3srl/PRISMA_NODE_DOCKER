#!/bin/bash

# Cerca tutti i file in sotto-cartelle tipo STAZIONE/STAZIONE_YYYYMMDD/captures/
# con timestamp contenente frazioni di secondo e li rinomina rimuovendo la frazione

find . -type f -path "./*/*_????????/captures/*" -name "*T??????.*_UT-*.fit" -print0 |
while IFS= read -r -d '' f; do
  dir=$(dirname "$f")
  base=$(basename "$f")
  # Rimuove .xxxxxxxx tra HHMMSS e _UT-...
  new=$(printf '%s\n' "$base" | sed -E 's/(T[0-9]{6})[.,][0-9]+(_UT-[0-9]+\.fit)$/\1\2/')
  if [ "$base" != "$new" ]; then
    mv -n -- "$f" "$dir/$new"  # -n: non sovrascrivere se il file di destinazione esiste
    echo "Rinominato: $base -> $new"
  fi
done
