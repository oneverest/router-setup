#!/bin/bash
set -ex
echo ${1}
echo ${1#-}

if [ "${1#-}" != "$1" ]; then
  set -- ls "$@"
  # set 12 34
fi

# echo "$@"

# set -ex

# 将环境变量保存至 /etc/default/locale
# rm -rf /etc/default/locale
# env >> /etc/default/locale
# 启动 crontab
# /etc/init.d/cron start
# echo 123 > "./test.doc"

# 启动 apache
# apache2-foreground
# ls
# p="$@"
# echo $p
exec "$@"