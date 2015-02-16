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

Für Windows ist ein deploy-Skript in Arbeit.

## Konventionen

* Textdateien müssen ausnahmslos mit __UTF-8__ enkodiert werden.
* Textdateien müssen ausnahmslos __Unix-Zeilenenden__ verwenden (etwas anderes akzeptiert GitHub ohnehin nicht).
* __Einrückung durch 4 Spaces__, nicht durch Tabs.

## LaTeX Dokumentation

Das Repository __EPR-RCR-Doc__ enthält die Quelldateien der zugehörigen LaTeX-Dokumentation. Das Repository ist als __Submodule__ mit diesem Repository verknüpft. Mehr zu Submodules in der [Git-Dokumentation](http://git-scm.com/book/en/v2/Git-Tools-Submodules).
