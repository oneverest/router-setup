#!/bin/sh

set -x

rm -rf /etc/default/locale
env >> /etc/default/locale
/etc/init.d/cron start

if [ "${1#-}" != "${1}" ]; then
  set -- apache2-foreground "$@"
fi

exec "$@"