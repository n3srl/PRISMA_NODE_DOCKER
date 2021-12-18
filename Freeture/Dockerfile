FROM ubuntu:xenial

#ARG DEBIAN_FRONTEND=noninteractive

#downloads
RUN apt-get -y update && apt-get install -y --no-install-recommends \
    wget xz-utils ca-certificates \
    && wget https://download-fallback.gnome.org/sources/aravis/0.4/aravis-0.4.1.tar.xz \
    && tar -xf aravis-0.4.1.tar.xz && rm aravis-0.4.1.tar.xz \
    && wget https://github.com/fripon/freeture/archive/refs/tags/v1.1.0.tar.gz \
    && tar -xvf v1.1.0.tar.gz && rm v1.1.0.tar.gz

#aravis
RUN apt-get install -y --no-install-recommends \
    autoconf libgtk-3-dev intltool libxml2-dev build-essential

RUN mv /aravis-0.4.1 /usr/local/aravis-0.4.1
WORKDIR /usr/local/aravis-0.4.1
RUN ./configure && make && make install

#freeture
RUN apt-get install -y --no-install-recommends libudev-dev  libssl-dev  libv4l-dev \
    libboost-all-dev libopencv-dev python-opencv \
    libcfitsio-dev  libgstreamer0.10-dev

RUN mv /freeture-1.1.0 /usr/local/freeture-1.1.0
WORKDIR /usr/local/freeture-1.1.0
RUN chmod +x bootstrap.sh && ./bootstrap.sh && ./configure && make && make install

#set UTC timezone
ENV TZ 'UTC'
RUN echo $TZ > /etc/timezone && \
    apt-get install -y --no-install-recommends tzdata && \
    rm /etc/localtime && \
    ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && \
    dpkg-reconfigure -f noninteractive tzdata

#clear space
RUN rm -rf /var/lib/apt/lists/* && apt-get clean && apt-get autoremove -y

#add a configuration files
COPY ["configuration.cfg","/usr/local/share/freeture/"]

WORKDIR /freeture

ENTRYPOINT ["freeture"]
CMD ["-l"] 