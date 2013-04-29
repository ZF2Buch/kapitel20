ZF2 Buch - Kapitel 20
=====================

Die Projektdateien für das Kapitel 20 vom Buch **Zend Framework 2 - Von den 
Grundlagen bis zur fertigen Anwendung** (*ISBN 978-3-8273-2994-3*) von Ralf Eggert 
aus dem Addison-Wesley Verlag installieren Sie wie folgt:

* Sie können die Projektdateien als ZIP von der Website http://www.awl.de/2994 
  unter Downloads oder von GitHub https://github.com/ZF2Buch/kapitel20 herunter
  laden und in einem geeigneten Verzeichnis entpacken, z.B.
```
  /home/devhost/zf2buch/kapitel20
```
  
* Alternativ wechseln Sie ins Verzeichnis `/home/devhost/zf2buch/` und clonen das
  GitHub Repository entsprechend, z.B.
```
    $ cd /home/devhost/zf2buch/
    $ git clone https://github.com/ZF2Buch/kapitel20.git
    $ cd kapitel20/
```
  
* Nun aktualisieren Sie den Composer und installieren das Projekt inklusive
  aller Abhängigkeiten
```
    $ php composer.phar selfupdate
    $ php composer.phar install
```

* Als Letztes müssen Sie einen Virtual Host für den Apache2 einrichten oder einen
  bestehenden entsprechend anpassen.
```
    $ sudo touch /etc/apache2/sites-available/luigis-pizza.local
    $ sudo gedit /etc/apache2/sites-available/luigis-pizza.local
```
  Der Virtual Host könnte so aussehen:
```
    <VirtualHost *>
      ServerName luigis-pizza.local
      DocumentRoot /home/devhost/zf2buch/kapitel20/public/
      AccessFileName .htaccess
      <Directory /home/devhost/zf2buch/kapitel20/public/>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
      </Directory>
    </VirtualHost>
```
  Weitere Details zum Einrichten des Virtual Hosts entnehmen Sie bitte den 
  Kapiteln *3.1.4 Virtual Host einrichten unter Linux* und *3.1.5 Virtual Host 
  einrichten unter Windows*
  
* Nun sollten Sie das Projekt unter http://luigis-pizza.local in Ihrem Browser 
  aufrufen können.

Hinweise zum Zend Framework Release 2.1.5
-----------------------------------------

Durch Änderungen im Routing wird im User Modul leider eine Exception geworfen:

* Route with name "user" does not have child routes
   
  Dies Problem tritt auf, weil an mehreren Stellen die Route "user/action" 
  verwendet wird. Diese wird jedoch nicht in der module.config.php definiert. Es
  gibt dort nur die "user" Route. Wird dies geändert, tritt der Bug nicht 
  mehr auf.
  