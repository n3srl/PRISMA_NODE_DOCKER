#!/bin/bash

function show_help {
    echo "$0 help"
    echo "FREETURE: ft <OPTIONS>"
    echo "$0 ft OBSERVER \"Mario Bianchi\""
    echo "$0 ft --station-name \"milano\""
    echo "$0 ft --start"
    echo "$0 ft --restart"
    echo "$0 ft --stop"
    echo "$0 ft --check" 
    echo "$0 ft --config" 
    echo "$0 ft --list" 
    echo "OPENVPN: vpn <OPTIONS>"
    echo "$0 vpn --switch [IP_PING]"
    echo "NTP: ntp <OPTIONS>"
    echo "$0 ntp --state"
}

FT_CONF=/usr/local/share/freeture/configuration.cfg
VPN_CONF=/etc/openvpn
OLD_PROFILE=oldprismaconf384.ovpn

case "$1" in

    "ft")

        VALUE=$(echo $3 | sed 's_/_\\/_g') #escape slashes /

        case "$2" in
            "--list")
                sudo docker run --rm --network host \
                    -v freeture-conf:/usr/local/share/freeture/ \
                    --name ft-temp lorenz10/freeture -l
                ;;
            "--check")
                sudo docker run --rm --network host \
                    -v freeture-conf:/usr/local/share/freeture/ \
                    --name ft-temp lorenz10/freeture -m 1
                ;;
            "--config")
                cat $FT_CONF
                ;;
            "--stop")
                sudo docker container stop -t 60 freeture
                ;;
            "--start")
                sudo docker container start freeture
                ;;
            "--restart")
                sudo docker container restart freeture
                ;;
            "--station-name")
                sudo sed  -i -e "s/DATA_PATH\ =.*/DATA_PATH\ =\ \/freeture\/$VALUE\//g" $FT_CONF
                sudo sed  -i -e "s/STATION_NAME\ =.*/STATION_NAME\ =\ $VALUE/g" $FT_CONF
                sudo sed  -i -e "s/TELESCOP\ =.*/TELESCOP\ =\ $VALUE/g" $FT_CONF
                sudo sed  -i -e "s/ACQ_REGULAR_PRFX\ =.*/ACQ_REGULAR_PRFX\ =\ $VALUE/g" $FT_CONF
                grep "DATA_PATH" $FT_CONF
                grep "STATION_NAME" $FT_CONF
                grep "TELESCOP" $FT_CONF
                grep "ACQ_REGULAR_PRFX" $FT_CONF
                ;;
            *)
                count=$(grep -o  $2 $FT_CONF | wc -l)
                if [ $count -ne 0 ] && [ $# -ge 3 ]
                then 
                    sudo sed  -i -e "s/$2\ =.*/$2\ =\ $VALUE/g" $FT_CONF
                    grep $2 $FT_CONF
                else
                    echo "FREETURE: Parameter \"$2\" not found in configuration file."
                fi
        esac
        ;;

    "vpn")
        
        case "$2" in
            "--switch")
                echo "VPN - START"

                NEW_PROFILE=$(basename $(find ${VPN_CONF} -type f -name "*.ovpn" | grep -v client))
                if [ -f "${VPN_CONF}/${NEW_PROFILE}" ]
                then
                    #switch connection
                    sudo mv ${VPN_CONF}/client.ovpn ${VPN_CONF}/${OLD_PROFILE} && sudo cp ${VPN_CONF}/${NEW_PROFILE} ${VPN_CONF}/client.ovpn
                    echo "VPN: switching to ${NEW_PROFILE}..."
                    sudo docker container restart -t 60 prisma-vpn

                    #waiting VPN startup process ends
                    sleep 30

                    #test connection
                    $PING_ADDR=$3
                    echo "VPN: ping to ${PING_ADDR:-10.8.0.1}..."

                    sudo docker exec -it prisma-vpn ping -c 5 -q ${PING_ADDR:-10.8.0.1} ; error=$?
                    if [ ${error} -eq 0 ]
                    then
                        echo "VPN: connection test passed"
                    else
                        echo "VPN: connection test failed"
                        if [ -f "${OLD_PROFILE}" ]
                        then
                            echo "VPN: back to old profile..."
                            sudo rm ${VPN_CONF}/client.ovpn && mv ${VPN_CONF}/${OLD_PROFILE} ${VPN_CONF}/client.ovpn 
                            sudo docker container restart -t 60 prisma-vpn
                        else
                            echo "VPN: backup connection not found."
                        fi
                    fi

                    #restart also this container
                    echo "VPN: restarting SSH container...your SSH session will be interrupted."
                    sudo docker container restart -t 60 prisma-ssh
                else
                    echo "VPN: new ovpn file not found."
                fi

            ;;
        *)  show_help
        esac
        ;;
    
    "ntp")
        case "$2" in
            "--state")
                #https://docs.fedoraproject.org/en-US/Fedora/18/html/System_Administrators_Guide/sect-Checking_if_chrony_is_synchronized.html
                sudo docker exec -it prisma-ntp chronyc tracking
                sudo docker exec -it prisma-ntp chronyc sources
                sudo docker exec -it prisma-ntp chronyc sourcestats
            ;;
        *)  show_help
        esac
        ;;

    "help")
        show_help
        ;;

    *)
        show_help  
esac




