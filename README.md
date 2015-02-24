EPR-CRC
=======

Steuerung einer Digitalkamera mittels OpenWRT im Rahmen einer Studienarbeit.

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

## Konventionen

* Textdateien müssen ausnahmslos mit __UTF-8__ enkodiert werden.
* Textdateien müssen ausnahmslos __Unix-Zeilenenden__ verwenden (etwas anderes akzeptiert GitHub ohnehin nicht).
* __Einrückung durch 4 Spaces__, nicht durch Tabs.

