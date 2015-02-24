@echo off

::
:: Deployment script that connects to an OpenWRT system, copies the app's data
:: and executes required setup steps.
::
:: Usage:
:: deploy.bat <IP or hostname> <optional port number>
::

:: ::::::::::::::::::::::::::::::::::::::::::
:: Helper functions
:: ::::::::::::::::::::::::::::::::::::::::::

:: Iterate through arguments 
IF "%1"=="" GOTO FailNoArg
IF "%1" == "/?" (
    GOTO Help
)ELSE (GOTO Continue)

:FailNoArg
ECHO Bitte geben Sie eine Server-IP an!
ECHO Please enter a server IP-Adress!
GOTO:EOF

:: Print a help page.
:Help
ECHO Usage: deploy.bat [IP or hostname] [optinal port number]
GOTO:EOF

:: ::::::::::::::::::::::::::::::::::::::::::
:: Main program
:: ::::::::::::::::::::::::::::::::::::::::::
:Continue
SET ssh_server=%1
IF "%2" == "" (
	SET ssh_port=22
	)ELSE (SET ssh_port=%2)
ECHO Server:
ECHO %ssh_server%

ECHO Port:
ECHO %ssh_port%

ECHO Putty Pfad:
ECHO %PROGRAMFILES%

SET /p ssh_pw=root password:

:: Stop web server
ECHO Stopping the http web server ...
plink.exe -ssh -P %ssh_port%  root@%ssh_server% -pw %ssh_pw% '/etc/init.d/uhttpd stop'

:: Copy HTML files, ESH templates, assets and CGI scripts.
ECHO Copying files to the router ...
winscp /command ^
    "option batch abort" ^
    "open scp://root:%ssh_pw%@%ssh_Server%:%ssh_port%/" ^
    "cd /www/" ^
	"put /webGUI/*" ^
    "exit"

:: Execute the setup script.
ECHO Executing setup script ...
rem "maybe use /dev/stdin < setup.sh instead of the following command?"
plink.exe -ssh -P %ssh_port%  root@%ssh_server% -pw %ssh_pw% 'sh' < setup.sh

:: Start web server.
ECHO Starting the http web server ...
plink.exe -ssh -P %ssh_port%  root@%ssh_server% -pw %ssh_pw% '/etc/init.d/uhttpd start'

ECHO Done!

:EOF