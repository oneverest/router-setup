#!/bin/bash
set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" <<-EOSQL
    CREATE USER freeswitch PASSWORD 'freeswitch';
    CREATE DATABASE freeswitch;
    GRANT ALL PRIVILEGES ON DATABASE freeswitch TO freeswitch;
    CREATE USER test PASSWORD 'test';
    CREATE DATABASE callcenter;
    GRANT ALL PRIVILEGES ON DATABASE callcenter TO test;
EOSQL