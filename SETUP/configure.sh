#!/bin/bash

BASE=$(pwd)
FILES="${BASE}/files"
VPN_CONF="${FILES}/prisma-node-vpn-guest.ovpn"
ELLE_ROOT="${FILES}/framework-base-php-elle"
SSH_KEY="${FILES}/chiave"
ELLE_PASS="${FILES}/passwd.txt"

#check all files present
if [ -f "${VPN_CONF}" ]; then
    if [ -d "${ELLE_ROOT}" ]; then
        if [[ -f "${SSH_KEY}" && -f "${SSH_KEY}.pub" ]]; then
            if [ -f "${ELLE_PASS}" ]; then
                
                echo "Creating volumes..."
                docker volume create freeture-data
                docker volume create freeture-conf
                docker volume create vpn-conf
                docker volume create orma-src
                docker volume create orma-keys

                echo "Filling volumes..."
                docker run --rm -i -v ${FILES}/:/src -v vpn-conf:/dst \
                alpine cp -v /src/client.ovpn /dst
                docker run --rm -i -v ${FILES}/framework-base-php-elle:/src -v orma-src:/dst \
                alpine cp -r /src/. /dst
                docker run --rm -i -v ${FILES}/:/src -v orma-keys:/dst \
                alpine cp -v /src/chiave /src/chiave.pub /src/passwd.txt /dst

                #Instead of creating so many volumes and coping files into them
                #it could have been possible to directly bind such files 
                #when starting the containers, however, in this case, 
                #such files could also be modified from the host machine

                echo "Compose up..."
                docker-compose up -d

                echo "Setting permissions..."
                docker exec -it prisma-ssh chmod -R 777 \
                /usr/local/share/freeture /home/prisma /etc/openvpn /prismadata
                docker exec -it prisma-orma chmod -R 777 /keys

                echo "Ended"

            else
                echo "Missing ${ELLE_PASS} file"
            fi
        else
            echo "Missing key files"
        fi
    else
        echo "Missing ${ELLE_ROOT} folder"
    fi
else
    echo "Missing ${VPN_CONF} file"
fi

#docker-compose stop; docker-compose rm -f; docker volume rm freeture-data freeture-conf vpn-conf orma-src orma-keys