#!/bin/bash

if [ "$1" = "-h" ] || [ "$1" = "--help" ]; then
    echo "Script di build per l'ambiente dashboard di prisma, effettua la build dei docker di produzione e sviluppo usando una immagine base sviluppata appositamente"
    echo ""
    echo "-h --help                Mostra questa finestra di dialogo"
    echo "-p --publish             Oltre che fare la build delle due immagini fa anche la push su docker hub (necessario login)"
    echo "-pd --develop            Oltre che la build delle due immagini, pubblica su docker hub l'immagine di sviluppo"
    echo "-pp --production         Oltre che la build delle due immagini, pubblica su docker hub l'immagine di produzione"
    exit 0
fi

echo "Clean build env"
rm -rf scripts/init.sql
rm -rf config/config.php
echo "Clean OK"

# MYSQL_PRISMA_PWD password utente prisma su database
# MYSQL_ADMIN_PWD hash della password utente admin sulla dashboard

export APP_HOSTNAME="monitoring.prisma.inaf"
export DOCKER_IMAGE_TAG="latest"

echo "Configuring APP_HOSTNAME as ${APP_HOSTNAME}"

echo "Build for production"
# Build for prod
export MYSQL_PRISMA_PWD="setyoutpassword"
export MYSQL_ADMIN_PWD='$2y$10$unfEo/AMpsd9Xv1Fj2bCPOgLbu3ZWkc5beO.z.C7e4tCsdDQt6mI.'

envsubst < scripts/init_base.sql > scripts/init.sql
sed -e "s|\${APP_HOSTNAME}|${APP_HOSTNAME}|g" \
    -e "s|\${MYSQL_PRISMA_PWD}|${MYSQL_PRISMA_PWD}|g" config/config_base.php > config/config.php

docker build --no-cache --build-arg MYSQL_PRISMA_PWD=${MYSQL_PRISMA_PWD} -t n3srl/prisma-dashboard-prod:${DOCKER_IMAGE_TAG} .


echo "Builded for production"

echo "Clean build env"
rm -rf scripts/init.sql
rm -rf config/config.php
echo "Clean OK"

echo "Build for dev"
# Build for prod
export MYSQL_PRISMA_PWD="setpasswordhere"
export MYSQL_ADMIN_PWD='$2y$10$P7yiTgvS2/AvfuMFqW7Y8.V9OUKvG8GzXkG4qjVJMMgOsmlxCdItu'

envsubst < scripts/init_base.sql > scripts/init.sql
sed -e "s|\${APP_HOSTNAME}|${APP_HOSTNAME}|g" \
    -e "s|\${MYSQL_PRISMA_PWD}|${MYSQL_PRISMA_PWD}|g" config/config_base.php > config/config.php

docker build --no-cache --build-arg MYSQL_PRISMA_PWD=${MYSQL_PRISMA_PWD} -t n3srl/prisma-dashboard-dev:${DOCKER_IMAGE_TAG} .
echo "Builded for dev"

if [ "$1" = "--publish" ] || [ "$1" = "-p" ] || [ "$1" = "-pd" ] || [ "$1" = "--develop" ] ; then
    echo "Release develop"
    docker push n3srl/prisma-dashboard-dev:${DOCKER_IMAGE_TAG}
fi

if [ "$1" = "--publish" ] || [ "$1" = "-p" ] || [ "$1" = "-pp" ] || [ "$1" = "--production" ] ; then
    echo "Release production"
    docker push n3srl/prisma-dashboard-prod:${DOCKER_IMAGE_TAG}
fi
