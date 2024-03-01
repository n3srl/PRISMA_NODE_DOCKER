FROM ubuntu:jammy

#ARG DEBIAN_FRONTEND=noninteractive
#for Debian don't consider RUN and do the command, for WORKDIR = cd

#downloads
RUN apt-get -y update 

#set UTC timezone
ENV TZ 'UTC'

#in Debian don't do RUN echo $TZ > /etc/timezone && \ but start from apt-get install -y --no-install-recommends tzdata && \
RUN echo $TZ > /etc/timezone && \
    apt-get install -y --no-install-recommends tzdata && \
    rm /etc/localtime && \
    ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && \
    dpkg-reconfigure -f noninteractive tzdata

#build essentials
RUN apt-get install -y --no-install-recommends \
    wget unzip \
    g++ clang cmake make \
    autoconf libgtk-3-dev intltool libxml2-dev build-essential git sudo git-lfs

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
	liblog4cpp5-dev pkg-config
	
RUN apt-get install -y --no-install-recommends \    
	libopencv-dev libopencv-contrib-dev  libopencv-core-dev

#Install arenasdk, Genicam, ffmpeg
RUN git clone https://github.com/n3srl/ArenaSDK.git /usr/local/ArenaSDK
WORKDIR /usr/local/ArenaSDK
RUN git lfs pull
RUN rm -rf .git
RUN mv /usr/local/ArenaSDK/ubuntu20/ArenaSDK_Linux_x64 /opt/arenasdk/
WORKDIR  /opt/arenasdk/
RUN chmod +x Arena_SDK_Linux_x64.conf
RUN ./Arena_SDK_Linux_x64.conf -cti /opt/arenasdk/GenICam/library/lib/Linux64_x64/

run file /opt/arenasdk/lib64/libsave.so

run file /opt/arenasdk/lib64/libavcored.so.0.1.84
run file /opt/arenasdk/lib64/libsavec.so
run file /opt/arenasdk/lib64/liblucidlogd.so.0.1.84
run file /opt/arenasdk/lib64/libsave.so
run file /opt/arenasdk/lib64/libsavecd.so.0
run file /opt/arenasdk/lib64/libarenad.so.0
run file /opt/arenasdk/lib64/libgentld.so
run file /opt/arenasdk/lib64/libarenacd.so.0.1.84
run file /opt/arenasdk/lib64/libsaved.so
run file /opt/arenasdk/lib64/libarenac.so.0.1.84
run file /opt/arenasdk/lib64/libsavecd.so.0.1.84
run file /opt/arenasdk/lib64/libarena.so
run file /opt/arenasdk/lib64/liblucidlog.so.0
run file /opt/arenasdk/lib64/libsavecd.so
run file /opt/arenasdk/lib64/libarenac.so
run file /opt/arenasdk/lib64/libsave.so.0.1.84
run file /opt/arenasdk/lib64/liblucidlog.so.0.1.84
run file /opt/arenasdk/lib64/liblucidlogd.so
run file /opt/arenasdk/lib64/libsaved.so.0
run file /opt/arenasdk/lib64/libavcore.so.0
run file /opt/arenasdk/lib64/libsavec.so.0
run file /opt/arenasdk/lib64/libarena.so.0.1.84
run file /opt/arenasdk/lib64/libarenad.so
run file /opt/arenasdk/lib64/libarenad.so.0.1.84
run file /opt/arenasdk/lib64/libsavec.so.0.1.84
run file /opt/arenasdk/lib64/libsaved.so.0.1.84
run file /opt/arenasdk/lib64/libgentl.so.0.1.84
run file /opt/arenasdk/lib64/libarenac.so.0
run file /opt/arenasdk/lib64/libgentld.so.0.1.84
run file /opt/arenasdk/lib64/libgentld.so.0
run file /opt/arenasdk/lib64/libavcored.so.0
run file /opt/arenasdk/lib64/libarenacd.so.0
run file /opt/arenasdk/lib64/libavcore.so
run file /opt/arenasdk/lib64/libarena.so.0
run file /opt/arenasdk/lib64/libgentl.so.0
run file /opt/arenasdk/lib64/libsave.so.0
run file /opt/arenasdk/lib64/libavcored.so
run file /opt/arenasdk/lib64/liblucidlog.so
run file /opt/arenasdk/lib64/libarenacd.so
run file /opt/arenasdk/lib64/liblucidlogd.so.0
run file /opt/arenasdk/lib64/libavcore.so.0.1.84
run file /opt/arenasdk/lib64/libgentl.so
run file /opt/arenasdk/GenICam/library/lib/Linux64_x64/libLog_gcc54_v3_3_LUCID.so
run file /opt/arenasdk/GenICam/library/lib/Linux64_x64/liblog4cpp_gcc54_v3_3_LUCID.so
run file /opt/arenasdk/GenICam/library/lib/Linux64_x64/libXmlParser_gcc54_v3_3_LUCID.so
run file /opt/arenasdk/GenICam/library/lib/Linux64_x64/libNodeMapData_gcc54_v3_3_LUCID.so
run file /opt/arenasdk/GenICam/library/lib/Linux64_x64/libGCBase_gcc54_v3_3_LUCID.so
run file /opt/arenasdk/GenICam/library/lib/Linux64_x64/libMathParser_gcc54_v3_3_LUCID.so
run file /opt/arenasdk/GenICam/library/lib/Linux64_x64/libGenApi_gcc54_v3_3_LUCID.so
run file /opt/arenasdk/ffmpeg/libavutil.so.56
run file /opt/arenasdk/ffmpeg/libavutil.so
run file /opt/arenasdk/ffmpeg/libavutil.so.56.14.100
run file /opt/arenasdk/ffmpeg/libavcodec.so
run file /opt/arenasdk/ffmpeg/libavformat.so.58
run file /opt/arenasdk/ffmpeg/libswresample.so
run file /opt/arenasdk/ffmpeg/libavcodec.so.58.18.100
run file /opt/arenasdk/ffmpeg/libavcodec.so.58
run file /opt/arenasdk/ffmpeg/libswresample.so.3
run file /opt/arenasdk/ffmpeg/libavformat.so
run file /opt/arenasdk/ffmpeg/libavformat.so.58.12.100
run file /opt/arenasdk/ffmpeg/libswresample.so.3.1.100

#Get freeture
RUN mkdir /usr/local/freeture-1.4.1
RUN git clone --branch freeture14 https://github.com/n3srl/freeture.git /usr/local/freeture-1.4.1/freeture_git 


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


