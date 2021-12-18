FROM linuxserver/openssh-server:2021.11.21

# add Docker tools
RUN apk add --no-cache --upgrade docker openrc && rc-update add docker boot

#add list of public keys to authenticate
COPY ["rsa.pub","/keys/"]