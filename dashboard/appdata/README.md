<p align="center">
  <img src="https://i.imgur.com/IHjGJBk.png" />
</p>

# PRISMA DASHBAORD
This repository contains the Web-Based backend interface for PRISMA Network.

## Installation

```console
# clone the repo
$ git clone https://github.com/n3srl/PRISMA_BACKEND.git

# copy into web root, change your webroot if needed
$ cp PRISMA_BACKEND /var/www/html

# change dbms host and credentials edit, /var/www/html/config/config.php
$ nano /var/www/html/config/config.php

#execute database initialization script
$ /var/www/html/mysql_init_script/init_db.sh
```

## Dependencies
```
sudo apt -y install php php-common
sudo apt -y install php-ssh2
sudo apt -y install php-mysqli
sudo apt -y install zip
```