# README

## OpenSIPS-CP

### Database initialization

1. Enter into postgres container

2. Run command as follows:
```sh
psql -h localhost -U opensips -d opensips < /tmp/db_schema.pgsql
```

### oreka
You can choose to use installer or build from source code

1. checkout source code
```
svn checkout svn://svn.code.sf.net/p/oreka/svn/trunk oreka-svn
```
