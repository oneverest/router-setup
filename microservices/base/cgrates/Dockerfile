FROM debian:stretch

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

RUN apt-get update && apt-get install -y \
  git \
  wget \
  iputils-ping

RUN wget http://www.cgrates.org/tmp_pkg/cgrates_0.9.1~rc8_amd64.deb -O /tmp/cgrates_0.9.1~rc8_amd64.deb

RUN dpkg -i /tmp/cgrates_0.9.1~rc8_amd64.deb

RUN apt-get update && apt-get install build-essential fakeroot dh-systemd net-tools -y

COPY ./config/cgrates.json /etc/cgrates/cgrates.json

RUN cp /usr/share/cgrates/tutorials/osips_native/cgrates/etc/init.d/cgrates /etc/init.d/cgrates

EXPOSE 2012
EXPOSE 2013
EXPOSE 2014
EXPOSE 2080
# CMD [ "service", "cgrates", "start" ]
# CMD [ "ping", "172.16.238.100" ]
CMD [ "cgr-engine", "-logger", "*stdout" ]