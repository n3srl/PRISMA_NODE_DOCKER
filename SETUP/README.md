
## Utente finale: installazione Prisma Docker

Questa guida è destinata a coloro che vogliono configurare il Client Prisma all'interno di Docker.

#### 1. Requisiti

Sulla macchina che si vuole collegare alla Camera è necessario:

1. Avere installato: [docker](https://docs.docker.com/engine/install/) e [docker-compose](https://docs.docker.com/compose/install/).
2. Avere installato wget
3. Avere installato unzip
4. Scaricare il file `PrismaDocker.zip` 
```sh 
wget https://github.com/n3srl/PRISMA_NODE_DOCKER/releases/download/1.4.0/PrismaDocker.zip
```
5. Decomprimere il file `PrismaDocker.zip` scaricabile dall'ultima [release](https://github.com/n3srl/PRISMA_NODE_DOCKER/releases) disponibile.

#### 2. Aggiunta files di configurazione

#### 3. Controllo visibilità della Camera

Prima di avviare i Container è consigliato verificare che Freeture sia in grado di vedere la Camera. E' possibile farlo tramite il comando:
```sh
docker run --rm --network host n3srl/freeture -l
```
il risultato dovrebbe essere simile al seguente (una volta terminato il download dell'Immagine), con la Camera in posizione 0 nella lista:

>[0]    NAME[Camera-name] SDK[ARAVIS] IP: XXX.XXX.XXX.XXX \
>[1]    VIDEO FILES \
>[2]    FRAMES DIRECTORY \

#### 4. Avvio dei Container

Assicurarsi di avere i privilegi amministrativi (root)

Posizionarsi all'interno della cartella `SETUP`.

Permettere l'esecuzione del file *configure.sh* con il comando:
```sh
chmod +x configure.sh
```

ed eseguire lo script, in modo che tutti i Container vengano configurati e avviati in automatico:
```sh
./configure.sh
```

## Amministratore Prisma: configurazione della Camera

Per configurare il Nodo Prisma è possibile accedere tramite SSH con l'utente `prisma`, oppure accedere all'interfaccia Orma, tramite browser, sulla porta 80.

#### 1. Controllo visibilità della Camera

Posizionarsi all'interno della cartella `/home/prisma` e lanciare nell'ordine:
```sh
sudo chmod +x prisma.sh
```
e:
```sh
./prisma.sh ft --list
```
il risultato dovrebbe essere simile al seguente, con la Camera in posizione 0 nella lista:

>[0]    NAME[Camera-name] SDK[ARAVIS] IP: XXX.XXX.XXX.XXX 
>[1]    VIDEO FILES 
>[2]    FRAMES DIRECTORY

#### 2. Configurazione di Freeture (disponibile anche su Orma)

Per modificare il file di configurazione *configuration.cfg* si può procedere in due modi:

1. modificare il file di configurazione pre-esistente, utilizzando lo script `prisma.sh` in questo modo:
```sh
./prisma.sh ft <PARAMETRO> <NUOVO_VALORE>
```
e.g. `./prisma.sh ft CAMERA_ID 2`.

2. sostituire il file *configuration.cfg* con una sua versione aggiornata tramite *scp*.
```sh
scp -i <KEY> /path/to/your/configuration.cfg prisma@<IP_NODO>:/usr/local/share/freeture/
```
IMPORTANTE: Tutte le directory su cui Freeture salva i dati devono essere contenute all'interno della cartella `/freeture`, ad esempio: `/freeture/log`, `/freeture/debug`.

Se si volesse aggiungere la Detection Mask, caricare il file *.bmp* all'interno della cartella `/prismadata` tramite *scp*:
```sh
scp -i <KEY> /path/to/your/mask.bmp prisma@<IP_NODO>:/prismadata/mask.bmp
```
e ricordarsi di abilitarla nel file di configurazione.

Una volta che la configurazione sarà terminata, è possibile verificarne la correttezza con:
```sh
./prisma.sh ft --check
```
se non verranno notificati errori, significa che la configurazione venga letta correttamente.
Riavviare Freeture:
```sh
./prisma.sh ft --restart 
```

Configurazione VPN
Per configurare la VPN, caricare il nuovo file di configurazione di tipo .ovpn nella cartella /home/prisma tramite il comando:

scp -i <KEY> /path/to/your/<STATION CODE>.ovpn prisma@<IP_NODO>:/home/prisma
  
#CONFIGURAZIONE OPENVPN
cp /home/prisma/<STATION CODE>.ovpn /etc/openvpn/client.conf
service openvpn restart
service ssh restart
exit
 
