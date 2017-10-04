# UNIJUB

Dies ist eine Docker-Version des Benutzer-Verzeichnisses *~unijub*, welches vom URZ archiviert wurde.

## Start

Die docker-compose.yml ist entsprechend den Notwendigkeiten anzupassen. Die möglichen Optionen sind
im Abschnitt `Konfiguration` erklärt.
Anschließend kann der Dienst mit

    docker-compose up

gestartet werden

## Datenkbank zurückspielen

Die archivierte Datenbank befindet sich im Ordner `/db-backup`

```bash
$# docker-compose exec db bash
$# gzip -dc /db-backup/unijub.sql.gz | mysql -u ${MYSQL_USER} -p${MYSQL_PASSWORD} ${MYSQL_DATABASE}
```

## Datenbank archivieren

Es empfiehlt sich, den Ordner `/db-backup` zu nutzen, da dieser auf ein separates Volume gemountet ist
```bash
$# docker-compose exec db bash
$# mysqldump -u ${MYSQL_USER} -p${MYSQL_PASSWORD} ${MYSQL_DATABASE} | gzip >/db-backup/unijub_`date +'%Y-%m-%d'`.sql.gz
```

## Benutzer einrichten für Admin-Zugang

Die Passwort-Datei wird im Ordner `/conf` gespeichert, welcher auf ein separates Volume gemountet ist

### interaktiv
```bash
$# docker-compose exec php htpasswd /conf/.htpasswd admin
```

### ohne Passwort-Prompt
```bash
$# docker-compose exec php htpasswd -b /conf/.htpasswd admin adminpw
```

## Konfiguration

Folgende Umgebungsvariablen stehen zur Konfiguration der Dienste zur Verfügung

* `MYSQL_HOST=db`:
der Host, unter welchem die Datenbank läuft. siehe Service-Name des Mariadb-Containers in der `docker-compose.yml`
* `MYSQL_DATABASE=unijub`:
der Datenbank-Name, in welcher die Datenbank abgelegt wird
* `MYSQL_USER=unijub`:
der Datenbank-Benutzer, welcher auf die Datenbank zugreift
* `MYSQL_PASSWORD=changeme`:
das Passwort des Datenbank-Benutzers