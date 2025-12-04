FROM ubuntu:jammy

#downloads packages
RUN apt-get -y update 

#set UTC timezone
ENV TZ 'UTC'

#in Debian don't do RUN echo $TZ > /etc/timezone && \ but start from apt-get install -y --no-install-recommends tzdata && \
RUN echo $TZ > /etc/timezone && \
    apt-get install -y --no-install-recommends tzdata && \
    rm /etc/localtime && \
    ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && \
    dpkg-reconfigure -f noninteractive tzdata


#install openvpn
RUN apt-get -y install systemctl openvpn sudo nano
RUN apt-get -y install iputils-ping
RUN apt-get -y install python3-pymysql
RUN apt-get -y install git git-lfs curl wget

RUN systemctl enable --now openvpn
RUN systemctl daemon-reload
RUN systemctl status openvpn || echo 'suppress errors'

#install ansible
RUN apt-get -y install ansible sshpass

RUN echo "test"
#clear space
RUN rm -rf /var/lib/apt/lists/* && apt-get clean && apt-get autoremove -y
