<p align="center">
  <img src="https://i.imgur.com/IHjGJBk.png" />
</p>

# ☄ PRISMA Workspace Driver 
This repository contains the driver that clone and sync the PRISMA workspace in the Database Node

# 🌲 Dependencies
```
pip install paramiko
pip install mysql-connector-python
```

# ⌚ Tempistiche
Effettuato un primo scan completo in data 23/06/22 del workspace su un DB locale e ha impiegato circa 16 minuti con 2 minuti di pausa, per scannerizzare detections, event, join nodes-events, calibrations.

I successivi scan sono incrementali, quindi richiederanno molto meno tempo.