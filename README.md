EPR-CRC
=======

Steuerung einer Digitalkamera mittels OpenWRT im Rahmen einer Studienarbeit.

## Benötigte Pakete

* php5
* php5-cgi
* php5-mod-json
* zoneinfo-core

Detaillierte Anweisungen bezüglich Konfiguration des OpenWrt-Routers sind der Dokumentation (PDF-Bericht) zu entnehmen.

## Deployment

Um die Anwendung auf ein OpenWrt-Gerät zu deployen, kann das deploy-Skript verwendet werden. Unter Mac OS X und Linux ist das die Datei `deploy.sh`.

```bash
git clone https://github.com/StudA-EPR/EPR-CRC.git
cd EPR-CRC/
./deploy.sh <username@IP_oder_Hostname> <Optionaler Port>
```

Für Windows dient hierfür die Datei `deploy.bat`.

```bash
git clone https://github.com/StudA-EPR/EPR-CRC.git
cd EPR-CRC/
./deploy.bat <username@IP_oder_Hostname> <Optionaler Port>
```

Welche Dateien deployt werden sollen, kann in der Datei `deploy_files.conf` festgelegt werden (hierfür können auch Wildcards verwendet werden). Alle dort aufgelisteten Dateien werden zu Beginn des Deploys auf dem Zielsystem gelöscht, falls dort bereits vorhanden und dann vom Entwicklersystem dorthin übertragen. Die Datei `deploy_files.conf` wird derzeit nur von der Unix-Version des Deploy-Skripts verwendet.

## Konventionen

* Textdateien müssen ausnahmslos mit __UTF-8__ enkodiert werden.
* Textdateien müssen ausnahmslos __Unix-Zeilenenden__ verwenden (etwas anderes akzeptiert GitHub ohnehin nicht).
* __Einrückung durch 4 Spaces__, nicht durch Tabs.

## Backups

Manchmal möchte man Backups der Webanwendung von einem OpenWrt System machen, sei es während der Entwicklung oder auch von einem Produktivsystem. Um nicht jedes mal manuell die Shell-Kommandos hierfür ausführen zu müssen, wurde ein kleines Hilfsskript für Unix-Systeme geschrieben, welches sich wie folgt verwenden lässt.

```bash
./backup.sh <IP oder Hostname> <Optionale Portnummer>
```

Anschließend liegt im aktuellen Verzeichnis eine komprimierte Backupdatei im Format `backup_<Zeitstempel>.tar.gz`.