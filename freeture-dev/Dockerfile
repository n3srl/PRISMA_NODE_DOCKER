FROM debian:buster

#ARG DEBIAN_FRONTEND=noninteractive

#downloads
RUN apt-get -y update 

#set UTC timezone
ENV TZ 'UTC'
RUN echo $TZ > /etc/timezone && apt-get install -y --no-install-recommends tzdata && rm /etc/localtime && ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && dpkg-reconfigure -f noninteractive tzdata

#build essentials
RUN apt-get install -y --no-install-recommends wget unzip g++ clang cmake make autoconf libgtk-3-dev intltool libxml2-dev build-essential git

#aravis
RUN apt-get install -y --no-install-recommends libaravis-0.8.0 libaravis-dev

#freeture
RUN apt-get install -y --no-install-recommends libudev-dev  libssl-dev  libv4l-dev 
    
RUN apt-get install -y --no-install-recommends libboost-all-dev 
        
RUN apt-get install -y --no-install-recommends libcfitsio-dev libtool

RUN apt-get install -y --no-install-recommends libopencv-dev libopencv-contrib-dev  libopencv-core-dev libopencv-core3.2

#RUN wget https://github.com/opencv/opencv/archive/refs/tags/3.4.0.tar.gz && tar -xf 3.4.0.tar.gz && rm 3.4.0.tar.gz
#RUN mkdir -p build 
#WORKDIR build
#RUN cmake  ../opencv-3.4.0
#RUN cmake --build .
#RUN make install
   
#RUN ls bin
#RUN ls lib

#RUN echo "/usr/local/lib/" > /etc/ld.so.conf.d/opencv.conf

#RUN ldconfig -v

#RUN find / -name "libopencv_core.so.3.4*"

#clear space
RUN rm -rf /var/lib/apt/lists/* && apt-get clean && apt-get autoremove -y


#ENTRYPOINT ["freeture"]
#CMD ["-l"] 


