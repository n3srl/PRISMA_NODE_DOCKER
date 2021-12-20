#!/bin/bash

echo -e "\n--------- VPN manager script ---------\n"

readonly VPN_DIR=</path/to/a/dir>
readonly VPN_IP=XX.XX.XX.XX
readonly VPN_PORT=5000

while getopts ":a:d: l r v h c s" opt
do
    case $opt in
        a)
        	echo -e "\nCERT - Generating certificate for $OPTARG" \
            && docker run -v $VPN_DIR:/etc/openvpn --rm -it kylemanna/openvpn easyrsa build-client-full $OPTARG nopass \
            && docker run -v $VPN_DIR:/etc/openvpn --rm kylemanna/openvpn ovpn_getclient $OPTARG > $OPTARG.ovpn \
            && echo -e "\nFILE - Configuration file generated successfully: $VPN_DIR/$OPTARG.ovpn"
        ;;
		d)
			echo "Revoking certificate for $OPTARG "
			docker exec -it vpn ovpn_revokeclient $OPTARG remove
		;;
		l)
			echo "View user list"
			docker exec -it vpn ovpn_listclients
		;;
		r)
			echo "Update certificate"
			docker-compose run --rm openvpn ovpn_getclient_all
			echo "openvpn-data/conf/"		
			;;
		s)	
			docker exec -it vpn cat /tmp/openvpn-status.log
		;;
		v)	
			echo "Version information"
			docker exec -it vpn openvpn --version
		;;
		c)	
			echo -e "\n1 - Generating configuration files for your IP..." \
			&& docker run -v $VPN_DIR:/etc/openvpn --rm kylemanna/openvpn ovpn_genconfig -u udp://$VPN_IP:$VPN_PORT \
			&& echo -e "\n2 - Configure the password of the VPN server (required to generate certificates)" \
			&& docker run -v $VPN_DIR:/etc/openvpn --rm -it kylemanna/openvpn ovpn_initpki \
			&& echo -e "\n3 - Starting Docker Container for VPN server..." \
			&& docker run -v $VPN_DIR:/etc/openvpn -d -p $VPN_PORT:1194/udp --cap-add=NET_ADMIN --name vpn --restart always kylemanna/openvpn
		;;
		h)
			echo -e "-a Add user certificate. eg: ./vpn.sh -a username\n"
			echo -e "-d Revocate user certificate. eg: -d username\n"
			echo -e "-l View user list. eg: -l \n"
			echo -e "-r Batch generation and update of client configuration files,catalog:openvpn-data/conf/clients. eg: -r\n"
			echo -e "-s Show status.\n"
			echo -e "-v View current version. eg: -v\n"
			echo -e "-c Configure and start the server. WILL OVERRIDE EXISTING CONFIGURATIONS! eg: ./vpn.sh -c\n"
			echo -e "-h Get help information. eg: -h\n"
		;;
        ?)
        	echo "Unknown parameter"
			echo "-h for help information"
        exit 1;;
    esac
done
