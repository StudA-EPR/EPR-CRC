ESH: Embedded Shell
===================

Da für das Webinterface der Kamerafernsteuerung HTML-Webseiten dynamisch generiert werden müssen, wird ein Templatingsystem benötigt.

Traditionelle Templatingsysteme wie PHP oder Java Server Pages (JSP) fallen aus, da sie - auf der stark eingeschränkten Routerhardware - nicht performant genug wären (Beleg durch Tests stehen noch aus). Das benötigte HTML-Markup in einem CGI-Programm zu generieren ist zwar möglich, widerspricht jedoch dem Paradigma Oberflächen und Logik zu trennen. Es würde außerdem Les- und Wartbarkeit des Codes verschlechtern.

Ein leichtgewichtiger Interpreter, der auf OpenWRT-Systemen bereits vorhanden ist, ist die Shell. Daher haben wir uns entschieden, ein schlankes Templatingsystem zu implementieren, welches es ermöglicht ausführbaren Shell-Code - mithilfe einer Syntax, die an Embedded Ruby (ERB) erinnert - in HTML-Dateien einzubetten. Dieser ausführbare Shell-Code wird dann vor der Auslieferung der Templatedatei an den Klienten ausgeführt.

## Implementierung

Der ESH-Interpreter ist selbst als Shell-Programm in der Datei `esh.sh` implementiert.

## Benutzung

Templatedateien werden vom Interpreter mit der Dateiendung `.html.esh` erwartet. Beim Aufruf des Interpreters muss die Dateiendung jedoch weggelassen werden. Der esh-Interpreter gibt den generierten HTML-Code auf der Standardausgabe aus (stdout).

```sh
$ esh templatedatei
```

Vom Wurzelverzeichnis dieses Git-Repositories könnte eine Templatedatei wie folgt ausgeführt werden:

```sh
$ cd esh
$ ./esh.sh examples/oneline_tags
```

## ESH-Templates: Syntax

Einzeilige Shellanweisungen können in einen esh-Tag gefasst werden: `<% shellcode %>`. Mehrzeiliger Shell-Code wird zwischen die Tags `<% esh_begin %>` und `<% esh_end %>` geschrieben.

Zum besseren Verständnis ein Beispieltemplate, das die Dateien in einem Verzeichnis auflistet:

```html
<!DOCTYPE html>
<html>
	<head>
		<title><% date %></title>
	</head>
	<body>
		<h1>Dateien in /Users/nilssommer/Documents</h1>
		<ul>
		<% esh_begin %>
			image_filenames=(/Users/nilssommer/Documents/*)
			for filename in "${image_filenames[@]}"
			do
				echo "<li>$filename</li>"
			done
		<% esh_end %>
		</ul>
	</body>
</html>

```

## Status

Der esh-Interpreter befindet sich noch in Entwicklung. Daher fehlen noch einige Dinge, wie beispielsweise:

* Unterstützung für Multi-Line-Tags.
* Korrekte Fehlerbehandlung.
* Ausgabe einer vordefinierten Fehlerseite bei nicht korrekter Ausführbarkeit von Shell-Code (i.d.R. bemerkbar durch Ausgaben auf der Standardfehlerausgabe stderr, diese müsste temporär umgeleitet und abgefangen werden).