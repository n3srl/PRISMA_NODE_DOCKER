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
RUN apt-get -y install systemctl openvpn 

RUN systemctl enable --now openvpn
RUN systemctl daemon-reload
RUN systemctl status openvpn && echo 'suppress errors'

#install ansible
RUN apt-get -y install ansible

#clear space
RUN rm -rf /var/lib/apt/lists/* || apt-get clean && apt-get autoremove -y
