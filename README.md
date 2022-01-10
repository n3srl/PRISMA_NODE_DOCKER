
[![Docker](https://badgen.net/badge/icon/docker?icon=docker&label)](https://docker.com/)  
[![Linux](https://svgshare.com/i/Zhy.svg)](https://svgshare.com/i/Zhy.svg) [![macOS](https://svgshare.com/i/ZjP.svg)](https://svgshare.com/i/ZjP.svg)

# Manuali

* [Utente finale: installazione Prisma Docker](https://github.com/lorenz10/iso-prisma/tree/main/SETUP#readme) 
* [Amministratore Prisma: configurazione della Camera](https://github.com/lorenz10/iso-prisma/tree/main/SETUP#readme)
* [Documentazione interna](https://github.com/lorenz10/iso-prisma#readme)

## Documentazione interna

#### Creazione VPN Prisma Guest

Per crearlo è stata usate la seguente Immagine Docker: 
[kylemanna/docker-openvpn](https://github.com/kylemanna/docker-openvpn), vedi la cartella `vpn-server` per maggiori info a riguardo.

#### Preparazione OS per NUC

Sul NUC è stato installato Debian 11 e sono state effettuate le seguenti modifiche:
  
  - la partizione di SWAP è stata rimpiazzata con uno *swapfile*, come da [guida](https://www.linuxuprising.com/2018/08/how-to-use-swap-file-instead-of-swap.html).
  - la partizione principale è stata ridimensionata a 100GB. Questo perchè Clonezilla può aumentare in automatico le dimensioni dell'ultima partizione dell'HDD clonato, adattandole alle dimensioni del nuovo HDD, ma non può rimpicciolirla. Per lo stesso motivo la partizione di SWAP contenuta alla fine del disco è stata rimossa.

#### Struttura dei Container

Il docker-compose file configura Container e Volume nel seguente modo:

![Component_diagram drawio](https://user-images.githubusercontent.com/37838538/147959506-8f137450-d5f8-41a3-9311-4a0975238352.png)

dove:
* **freeture-conf** contiene il file di configurazione di Freeture: *configuration.cfg*.
* **freeture-data** contiene le captures di Freeture.
* **vpn-conf** contiene il file *client.ovpn* che viene utilizzato per la configurazione della VPN.
* **orma-src** contiene i sorgenti di Orma.
* **orma-keys** contiene i file *chiave* e *chiave.pub* che servono al container di Orma ad accedere al container SSH, e il file *passwd.txt* contenente il database di utenti che possono accede a Orma.

Il Container **prisma-ssh** è accessibile tramite la porta 22 da VPN o la 2222 da localhost.
Il Container **prisma-orma** è accessibile tramite la porta 80 da VPN o la 8080 da localhost.

#### Clonazione del disco

1 . Bisogna anzitutto creare un SSH server, in rete locale, dove verranno salvate le immagini del disco. Si consiglia di configurare il server con Docker:
```sh
docker run -d  --name=openssh-server -e PUID=1000 -e PGID=1000 \
-e TZ=Europe/London -e PASSWORD_ACCESS=true -e USER_PASSWORD=<PASSWORD> \
  -e USER_NAME=<USER> -p <PORT>:2222 \
 -v <path/to/dir>:/clonezilla  lscr.io/linuxserver/openssh-server
```

2 . Flashare la [Clonezilla live ISO](https://clonezilla.org/downloads.php)  su chiavetta USB con il software [balenaEtcher](https://www.balena.io/etcher/).

3 . Collegare la chiavetta con Clonezilla al NUC e seguire i punti "a" o "b" a seconda delle necessità.

![Untitled Diagram drawio](https://user-images.githubusercontent.com/37838538/148212225-e32cef9b-96f2-4b3b-a547-91b2bde3a5eb.png)

4A. Per creare un'immagine del disco che verrà salvata sul server SSH: `device-image` -> `ssh_server` -> `dhcp` e inserire i dati del server SSH che è stato configurato in precedenza (la cartella in cui salvare le immagini è */clonezilla*). 
Successivamente selezionare: `Expert` -> `savedisk`, selezionare il disco da ripristinare e lasciare i restanti campi a default. 

4B. Per creare un'ISO del disco che verrà salvata sul server SSH: stessa cosa del punto 4A, ma selezionare `recovery-iso-zip` al posto di `savedisk`. 
Successivamente selezionare le opzioni:
- destination device: `ask_user` 
- extra parameters: assicurarsi che `-r` sia selezionato
- advanced parameters: `-k1 create partition table proportionally`
- type of file: `iso`

5A. Per ripristinare un'immagine del disco dal server SSH: stessa cosa del punto 4A, ma selezionare  `restoredisk` al posto di `savedisk`.  Selezionare le opzioni `-k1 create partition table proportionally` e assicurarsi che `-r` sia selezionata.

5B. Per effettuare il rispristino tramite la ISO generata, flasharla su chiavetta, inserirla nel dispositivo di destinazione e seguire le istruzioni a schermo.

#### Configurazione BIOS del NUC

Tramite questa procedura, in caso di spegnimento dovuto ad interruzione di corrente, la macchina sarà in grado di riavviarsi automaticamente una volta terminata l'interruzione.

All'avvio della macchina comparirà a schermo il GRUB di Debian. Selezionare `system setup`. La macchina si riavvierà in automatico e aprirà il BIOS.

Selezionare le seguenti: `advanced` -> `power management setup` -> `Restore after AC loss` e impostare `power on`. Salvare le modifiche e riavviare la macchina dal pannello `save & exit` e poi `save changes and reboot`.

