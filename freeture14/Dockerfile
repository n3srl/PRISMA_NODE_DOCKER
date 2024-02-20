FROM ubuntu:focal

#ARG DEBIAN_FRONTEND=noninteractive

#downloads
RUN apt-get -y update 

#set UTC timezone
ENV TZ 'UTC'
RUN echo $TZ > /etc/timezone && \
    apt-get install -y --no-install-recommends tzdata && \
    rm /etc/localtime && \
    ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && \
    dpkg-reconfigure -f noninteractive tzdata

#build essentials
RUN apt-get install -y --no-install-recommends \
    wget unzip \
    g++ clang cmake make \
    autoconf libgtk-3-dev intltool libxml2-dev build-essential git

#aravis
RUN apt-get install -y --no-install-recommends \
    libaravis-0.8.0 libaravis-dev

#freeture
RUN apt-get install -y --no-install-recommends \
    libudev-dev  libssl-dev  libv4l-dev 
    
RUN apt-get install -y --no-install-recommends \
    libboost-all-dev 
        
RUN apt-get install -y --no-install-recommends \    
    libcfitsio-dev libtool

RUN apt-get install -y --no-install-recommends \    
	libopencv-dev libopencv-contrib-dev  libopencv-core-dev

#Get freeture
RUN mkdir /usr/local/freeture-1.4.1
RUN git clone --branch acq_thread_refactoring https://github.com/n3srl/freeture.git /usr/local/freeture-1.4.1/freeture_git 


#Install arenasdk, Genicam, ffmpeg
RUN git clone https://github.com/n3srl/ArenaSDK.git /usr/local/ArenaSDK
RUN mv /usr/local/ArenaSDK/ubuntu20/ArenaSDK_Linux_x64 /opt/arenasdk/
WORKDIR  /opt/arenasdk/
RUN chmod +x Arena_SDK_Linux_x64.conf
RUN ./Arena_SDK_Linux_x64.conf -cti

#Build freeture
WORKDIR /usr/local/freeture-1.4.1/freeture_git/cmake/
RUN cmake .
RUN make 
RUN make install


#clear space
RUN rm -rf /var/lib/apt/lists/* && apt-get clean && apt-get autoremove -y

#add a configuration files
COPY ["configuration.cfg","/usr/local/share/freeture/"]

WORKDIR /freeture




ENTRYPOINT ["freeture"]
CMD ["-l"] 


