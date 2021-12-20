
# Manuale Prisma Docker (outdated)

[![Docker](https://badgen.net/badge/icon/docker?icon=docker&label)](https://docker.com/)  
[![Linux](https://svgshare.com/i/Zhy.svg)](https://svgshare.com/i/Zhy.svg) [![macOS](https://svgshare.com/i/ZjP.svg)](https://svgshare.com/i/ZjP.svg)

## Utente finale: installazione Prisma Docker

Questa guida è destinata a coloro che vogliono configurare il Client Prisma all'interno di Docker.

#### 1. Requisiti

Sulla macchina che si vuole collegare alla Camera è necessario:

1. Avere installato i programmi: [docker](https://docs.docker.com/engine/install/) e [docker-compose](https://docs.docker.com/compose/install/) ed avere i privilegi necessari per eseguirli.

2. Scaricare e decomprimere il file `PrismaDocker.zip`. Al suo interno sono contenuti tutti i files di configurazione dei Container.

#### 2. File configurazione VPN

Posizionare il file *client.ovpn*, fornito da Prisma, all'interno della folder `prisma-docker/conf`.

#### 3. Controllo visibilità della Camera [opzionale, consigliato]

Prima di avviare i Container è consigliato verificare che Freeture sia in grado di vedere la Camera. E' possibile farlo tramite il comando:
```sh
docker run --rm --network host lorenz10/freeture freeture -l
```
il risultato dovrebbe essere simile al seguente (dopo il download dell'Immagine), con la Camera in posizione 0 nella lista:

>[0]    NAME[Camera-name] SDK[ARAVIS] IP: XXX.XXX.XXX.XXX 
>[1]    VIDEO FILES 
>[2]    FRAMES DIRECTORY

#### 4. Avvio dei Container

Posizionarsi all'interno di `prisma-docker`.
Creare i Volumi necessari:
```sh
docker volume create ssh-home && \
docker volume create freeture-data && \
docker volume create freeture-conf && \
docker volume create vpn-conf && \
docker volume create ssh-key
```
Aggiungere i file necessari all'interno dei Volumi:
```sh
docker run --rm -i -v $(pwd)/conf:/src -v vpn-conf:/dst \
alpine cp /src/client.ovpn /dst && \
docker run --rm -i -v $(pwd)/home:/src -v ssh-home:/dst \
alpine cp /src/prisma.sh /dst && \
docker run --rm -i -v $(pwd)/key:/src -v ssh-key:/dst \
alpine cp /src/rsa.pub /dst
```
Avviare i Container:
```sh
docker-compose up -d
```
Una volta scaricate le Immagini Docker, il risultato ottenuto dovrebbe essere il seguente:
>Creating prisma-vpn ... done
>Creating prisma-ssh ... done
>Creating freeture   ... done

Impostare i privilegi per l'accesso e la modifica da remoto dei Volumi:
```sh
docker exec -it prisma-ssh chown -R prisma:prisma \
/usr/local/share/freeture /home/prisma /etc/openvpn /prismadata
```

#### 5. Prisma admin

A questo punto sarà necessario comunicare all'amministratore di Rete Prisma la password impostata al passo precedente, per permettergli di accedere e configurare da remoto i Container di Freeture e della VPN.


## Amministratore Prisma Network: configurazione della Camera

L'accesso al Nodo Prisma è consentito sulla porta 22 all'utente `prisma`.  

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

#### 2. Configurazione di Freeture

Per modificare il file di configurazione *configuration.cfg* si può procedere in due modi:

1. modificare il file di configurazione pre-esistente, utilizzando lo script `prisma.sh` in questo modo:
```sh
./prisma.sh ft <PARAMETRO> <NUOVO_VALORE>
```
e.g. `./prisma.sh ft CAMERA_ID 2`
2. sostituire il file *configuration.cfg* con una sua versione aggiornata tramite *scp*.
```sh
scp -i <KEY> /path/to/your/configuration.cfg prisma@<IP_NODO>:/usr/local/share/freeture/
```
Tutte le directory di Freeture devono essere contenute all'interno della cartella `/freeture`, ad esempio: `/freeture/log`, `/freeture/debug`.
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
  
#### 3. Configurazione VPN

Per configurare la VPN, caricare il nuovo file di configurazione di tipo *.ovpn* nella cartella `/home/prisma` tramite il comando:
```sh
scp -i <KEY> /path/to/your/file.ovpn prisma@<IP_NODO>:/etc/openvpn
```
il file non deve chiamarsi `client.ovpn`!
Successivamente si dovrà lanciare lo script `vpn.sh`, che eseguirà lo switch alla nuova rete VPN:
```sh
./prisma.sh vpn --switch <IP>
```
dove `\<IP\>` è l'indirizzo da pingare per verificare il corretto accesso alla VPN (default: 10.8.0.1).
