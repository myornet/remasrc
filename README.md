# Registro Municipal de Autogestión Social

## Instalacion

```bash
# Requerimientos de software
PHP 5.6
Mysql 5.7
Apache 2.4 ModRewrite Enabled

# Clonado de repositorio

git clone https://github.com/cipbyte/remasrc.git remasrc
cd remasrc
```

```bash
# Inicializacion de la base de datos

mysql -h nombre_servidor -u nombre_usuario -p
source ./install/database.sql;
source ./install/setup.sql;
quit
```

```bash
# permisos de escritura

chmod 777 ./app/webroot/logs/*
chmod 777 ./app/tmp/*
```

```bash
# Lanzador
http://localhost/remasrc

```
