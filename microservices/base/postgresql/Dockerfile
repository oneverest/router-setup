FROM postgres:9.6

ENV TZ=Asia/Chongqing

RUN mv /etc/apt/sources.list /etc/apt/sources.list.bak && \
    ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone && \
    echo "deb http://mirrors.163.com/debian/ jessie main non-free contrib" > /etc/apt/sources.list && \
    echo "deb http://mirrors.163.com/debian/ jessie-updates main non-free contrib" >> /etc/apt/sources.list && \
    echo "deb http://mirrors.163.com/debian/ jessie-backports main non-free contrib" >> /etc/apt/sources.list && \
    echo "deb-src http://mirrors.163.com/debian/ jessie main non-free contrib" >> /etc/apt/sources.list && \
    echo "deb-src http://mirrors.163.com/debian/ jessie-updates main non-free contrib" >> /etc/apt/sources.list && \
    echo "deb-src http://mirrors.163.com/debian/ jessie-backports main non-free contrib" >> /etc/apt/sources.list && \
    echo "deb http://mirrors.163.com/debian-security/ jessie/updates main non-free contrib" >> /etc/apt/sources.list && \
    echo "deb-src http://mirrors.163.com/debian-security/ jessie/updates main non-free contrib" >> /etc/apt/sources.list

COPY ./init-user-db.sh /docker-entrypoint-initdb.d/
COPY ./db_schema.pgsql /tmp/
RUN chmod +x /docker-entrypoint-initdb.d/init-user-db.sh