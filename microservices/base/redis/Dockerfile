FROM redis:4.0.10-stretch

ENV TZ=Asia/Chongqing

RUN mv /etc/apt/sources.list /etc/apt/sources.list.bak && \
    ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone