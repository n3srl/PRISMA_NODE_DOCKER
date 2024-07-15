# Prisma Dashboard

La folder corrente contiene le info necessarie per buildare le immagini docker legate alla dashboard prisma e rilasciare le immagini.

## Premessa
I container sono buildati a partire dall'immagine n3srl/docker-lamp https://github.com/thebrohodev/docker-lamp
L'immagine è un fork di https://github.com/mattrayner/docker-lamp alla quale sono state fatte le seguenti modifiche:
1. Modificata l'immagine base da 'phusion/baseimage:focal-1.1.0' a 'ubuntu:20.04' usando il parametro 'BASE_IMAGE' per supporto dell'architettura amd64
2. Script di inizializzazione mysql al quale sono state rimosse righe relative all'utente pm non presente e che quindi creava errori in inizializzazione

L'immagine n3srl/docker-lamp viene buildata tramite il seguente comando docker build --no-cache --build-arg BASE_IMAGE=ubuntu:20.04 -t n3srl/docker-lamp:latest .

## Build delle immagini
La build delle immagini avviene tramite il supporto dello script 'build.sh' che si occupa della configurazione, della build e del rilascio delle immagini

All'interno del file build.sh possono essere configurate le seguenti variabili:

- APP_HOSTNAME: default a monitoring.prisma.inaf, viene scritta nei file di configurazione di orma e consente il collegamento al database
- DOCKER_IMAGE_TAG: Definisce il tag con cui vengono create le immagini
- MYSQL_ADMIN_PWD: Configura la password dell'utente admin della dashboard
- MYSQL_PRISMA_PWD: Configura la password di accesso al database per l'utente prisma

MYSQL_ADMIN_PWD, MYSQL_PRISMA_PWD sono presenti due volte e possono essere diversificate in base all'ambiente (DEV,PROD)

## Parametri build.sh
Lo script può essere lanciato con uno dei seguenti parametri
- -h --help Mostra la finestra di aiuto
- -p --publish Oltre che fare la build delle due immagini fa anche la push su docker hub (necessario login)
- -pd --develop Oltre che la build delle due immagini, pubblica su docker hub l'immagine di sviluppo
- -pp --production Oltre che la build delle due immagini, pubblica su docker hub l'immagine di produzione

 ## File di supporto
/appdata: Contiene i file di orma dashboard (UI)
/config: Contiene i mock dei file di configurazione
/data: Contiene i dati di inizializzazione 
/data/prisma_dump.sql: E' il database di prisma dashboard al 15/07/2024, usato per l'nizializzazione dell'immagine, se l'immagine viene avviata non configurata, si carica con quel database come base (utile in caso di trasferimento e aggiornamento)
/scripts: Contiene i mock degli script si inizializzazione in particolare .sql che inizializza gli utenti e il database

## docker-compose.yml
Il file docker-compose.yml è configurato per eseguire entrambe le dashboard (produzione e sviluppo). mappa le porte 10200 e 10100 sulla 80 del container per il webserver apache e mappa i database nelle folder 
- /var/lib/docker/volumes/db_data_dev => Database di sviluppo 
- /var/lib/docker/volumes/db_data_prod => Database di produzione

In modo da garantire la persistenza del database

## Funzionamento
Una volta avviato lo script build.sh, in base ai parametri saranno creati a partire dai mock i file da usare per il setup del container, verranno copiati nel container per essere usati dall'immagine base (vedi dockerfile)
