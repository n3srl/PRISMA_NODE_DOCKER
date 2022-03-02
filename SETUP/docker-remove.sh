docker-compose stop
docker-compose rm -sf
docker volume prune #1.b rimozione dei volumi
docker images #1.c check images
#docker rmi n3srl/openssh-server #1.c rimozione immagine openssh
docker rmi n3srl/orma-webmin #1.c rimozione immagine webmin
docker rmi n3srl/openvpn-client #1.c rimozione client openvpn
docker rmi n3srl/freeture  #rimozione hello workls
docker rmi hello-world #rimozione hello workls