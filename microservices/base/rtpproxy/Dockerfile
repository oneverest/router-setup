FROM debian:stretch-slim
MAINTAINER Ian Blenke <ian@blenke.com>

ENV TZ=Asia/Chongqing

RUN mv /etc/apt/sources.list /etc/apt/sources.list.bak && \
    ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone && \
    echo "deb http://mirrors.163.com/debian/ stretch main non-free contrib" > /etc/apt/sources.list && \
    echo "deb http://mirrors.163.com/debian/ stretch-updates main non-free contrib" >> /etc/apt/sources.list && \
    echo "deb http://mirrors.163.com/debian/ stretch-backports main non-free contrib" >> /etc/apt/sources.list && \
    echo "deb-src http://mirrors.163.com/debian/ stretch main non-free contrib" >> /etc/apt/sources.list && \
    echo "deb-src http://mirrors.163.com/debian/ stretch-updates main non-free contrib" >> /etc/apt/sources.list && \
    echo "deb-src http://mirrors.163.com/debian/ stretch-backports main non-free contrib" >> /etc/apt/sources.list && \
    echo "deb http://mirrors.163.com/debian-security/ stretch/updates main non-free contrib" >> /etc/apt/sources.list && \
    echo "deb-src http://mirrors.163.com/debian-security/ stretch/updates main non-free contrib" >> /etc/apt/sources.list

WORKDIR /usr/local/src
RUN set -ex && apt-get update && apt-get install -y \
    git \
    iputils-ping \
    libnet-ifconfig-wrapper-perl \
    && git clone -b master https://github.com/sippy/rtpproxy.git && \
    git -C rtpproxy submodule update --init --recursive


WORKDIR /usr/local/src/rtpproxy
RUN apt-get update && apt-get install -y \
    gcc \
    file \
    m4 \
    make \
    automake \
    autoconf \
    && ./configure \
    && make \
    && make install
#


#RUN export DEBIAN_FRONTEND=noninteractive && \
#    apt-get update -qqy && \
#    touch ./debian/flavors/no_ngcp && \
#    apt-get install -qqy dpkg-dev debhelper iptables-dev libcurl4-openssl-dev libglib2.0-dev libhiredis-dev libpcre3-dev libssl-dev libxmlrpc-core-c3-dev markdown zlib1g-dev module-assistant dkms gettext && \
#    dpkg-checkbuilddeps && \
#    dpkg-buildpackage -b -us -uc && \
#    dpkg -i /*.deb && \
#    ( ( apt-get install -y linux-headers-$(uname -r) linux-image-$(uname -r) && \
#        module-assistant update && \
#        module-assistant auto-install ngcp-rtpengine-kernel-source ) || true )
#
#ADD run.sh /run.sh
#RUN chmod 755 /run.sh
#

#EXPOSE $LISTEN_PORT

RUN set -ex && \
    apt-get update && \
    apt-get install -y tcpdump && \
    mkdir /var/lib/rtpproxy

CMD rtpproxy -F -f -P -r /var/lib/rtpproxy -A $ADVERTISE_IP -l 172.16.238.102 -s udp:*:$LISTEN_PORT -n tcp:10.10.32.38:22222 -d DBUG -m $MIN_PORT -M $MAX_PORT
# CMD rtpproxy -F -f -P -r /var/lib/rtpproxy -A $ADVERTISE_IP/10.10.32.38 -l $ADVERTISE_IP/10.10.32.38 -s udp:*:$LISTEN_PORT -n tcp:10.10.32.38:22222 -d DBUG -m $MIN_PORT -M $MAX_PORT

