#Setting permissions

echo "Setting permissions..."
docker exec -it prisma-orma chown -R www-data:www-data /var/www/html/tmp-media
docker exec -it prisma-orma chmod -R 770 /var/www/html/tmp-media
docker exec -it prisma-orma chown -R www-data:www-data /var/www/html/info-media
docker exec -it prisma-orma chmod -R 770 /var/www/html/info-media
docker exec -it prisma-orma chown -R www-data:www-data /usr/local/share/freeture
docker exec -it prisma-orma chmod -R 770 /usr/local/share/freeture
chown -R root:prisma /etc/openvpn
chmod -R 775 /etc/openvpn
chown -R root:prisma /etc/prometheus
chmod -R 775 /etc/prometheus

echo "Ended"

          
