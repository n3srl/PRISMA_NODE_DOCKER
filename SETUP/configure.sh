#!/bin/bash

BASE=$(pwd)
FILES="${BASE}/files"
ELLE_ROOT="${FILES}/framework-base-php-elle"
SSH_KEY="${FILES}/chiave"
ELLE_PASS="${FILES}/passwd.txt"

#check all files present
if [[ -f "${SSH_KEY}" && -f "${SSH_KEY}.pub" ]]; then
    if [ -f "${ELLE_PASS}" ]; then
        	
        echo "Creating volumes..."
        docker volume create freeture-data
        docker volume create freeture-conf
        docker volume create orma-src
        docker volume create orma-keys
        
        echo "Fetching source code from git..."
        git clone https://github.com/n3srl/PRISMA_NODE_WEBMIN.git ${FILES}/framework-base-php-elle

        echo "Filling volumes..."
        docker run --rm -i -v ${FILES}/framework-base-php-elle:/src -v orma-src:/dst \
        alpine cp -r /src/. /dst
        docker run --rm -i -v ${FILES}/:/src -v orma-keys:/dst \
        alpine cp -v /src/chiave /src/chiave.pub /src/passwd.txt /dst

        echo "Compose up..."
        docker compose up -d

        echo "Setting permissions..."
	docker exec -it prisma-orma chown -R prisma:www-data /var/www/html/tmp-media
	docker exec -it prisma-orma chmod -R 770 /var/www/html/tmp-media
	docker exec -it prisma-orma chown -R prisma:www-data /var/www/html/info-media
	docker exec -it prisma-orma chmod -R 770 /var/www/html/info-media
	docker exec -it prisma-orma chown -R prisma:www-data /usr/local/share/freeture
	docker exec -it prisma-orma chmod -R 770 /usr/local/share/freeture
	docker exec -it prisma-orma chown -R prisma:prisma /freeture
	docker exec -it prisma-orma chmod -R 770 /freeture
	docker exec -it prisma-orma chown -R prisma:www-data /keys
	docker exec -it prisma-orma chmod -R 770 /keys
        chown -R prisma:prisma /etc/openvpn
        chmod -R 775 /etc/openvpn
		#chown -R prometheus:prisma /etc/prometheus
        #chmod -R 775 /etc/prometheus
        
        echo "Ended"

    else
        echo "Missing ${ELLE_PASS} file"
    fi
else
    echo "Missing key files"
fi
  

#docker-compose stop; docker-compose rm -f; docker volume rm freeture-data freeture-conf vpn-conf orma-src orma-keys
