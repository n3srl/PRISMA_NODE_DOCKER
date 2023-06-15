#!/bin/sh

#Setting permissions

echo "Setting permissions..."
docker exec -it prisma-orma chown -R root:www-data /var/www/html/tmp-media
docker exec -it prisma-orma chmod -R 770 /var/www/html/tmp-media
docker exec -it prisma-orma chown -R root:www-data /var/www/html/info-media
docker exec -it prisma-orma chmod -R 770 /var/www/html/info-media
docker exec -it prisma-orma chown -R root:www-data /usr/local/share/freeture
docker exec -it prisma-orma chmod -R 770 /usr/local/share/freeture
docker exec -it prisma-orma chown -R root:www-data /freeture
docker exec -it prisma-orma chmod -R 770 /freeture
docker exec -it prisma-orma chown -R root:www-data /keys
docker exec -it prisma-orma chmod -R 770 /keys
chown -R root:prisma /etc/openvpn
chmod -R 775 /etc/openvpn
#chown -R prometheus:prisma /etc/prometheus
#chmod -R 775 /etc/prometheus
chmod 666 /var/run/docker.sock

chown -R prisma:www-data /prismadata/
chmod -R 777 /prismadata/
chmod -R 775 /etc/openvpn



echo "Ended"

          
