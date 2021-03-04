# Easy Servizi - Sistema Informatico Aziendale

Per completare eseguire i seguenti passaggi una volta effettato il clone del seguente repository:


1.Alla clonazione del repository vanno aggiunte le seguenti directory (Da prelevare da macchina di produzione):

    1.1 magazzino\vendor
    1.2 magazzino\writable



2.Funzionamento in locale su db:

    2.1 Importare il db da INT_MAGAZZINO_STRUCTURE.sql .

    2.2 Creazione utente Mysql eseguendo i seguenti comandi:

        CREATE USER 'umagazzino'@'%' IDENTIFIED BY '';

        GRANT ALL PRIVILEGES ON *.* TO 'umagazzino'@'%'



3.Per l'esecuzione del portale , creare il virtual host su Apache (su Xampp):

    3.1 Aggiungere il contenuto nel file "httpd-vhosts.conf" nella directory  "C:\xampp\apache\conf\extra" :


        <VirtualHost *:80>
            ServerAdmin admin@localhost
            DocumentRoot "c:/xampp/htdocs"
            ServerName localhost
            ServerAlias www.localhost.com
            ErrorLog "C:/xampp/apache/logs/localhost-error.log"
            CustomLog "C:/xampp/apache/logs/localhost-access.log" common
        </VirtualHost>

        <VirtualHost *:80>
            DocumentRoot "c:/xampp/htdocs/portale-sia"
            ServerName portale.sia
            <Directory "c:/xampp/htdocs/portale-sia">
            </Directory>
        </VirtualHost>


    3.2 Assicurarsi che l'url nel file di configurazione in app/config/App.php sia corretto:

        "public $baseURL = 'http://portale.sia/';"


    3.3 Infine modificare il virtual host:

      "C:\Windows\System32\drivers\etc\hosts"

    3.4 Aggiungendo il contenuto

      "127.0.0.1 portale.sia"




