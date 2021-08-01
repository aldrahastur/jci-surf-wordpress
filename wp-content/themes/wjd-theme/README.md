# Wordpress Theme Wirtschaftsjunioren Deutschland e.V.

# Voraussetzungen
Um das Theme hochladen und installieren zu können sowie die Demo Daten zu importieren, ist es nötig, dass der Server bestimmte PHP-Einstellungen korrekt gesetzt hat.

Folgende Werte sind als Minimums empfohlen:

- memory_limit = 200M
- max_execution_time = 60
- post_max_size = 16M
- upload_max_filesize = 16M

# Installation
## Theme importieren
![Screenshot Theme Installation](/doc/theme-upload.png "Theme Installation")

Im Menüpunkt “Design” auf den Unterpunkt “Themes” klicken und dort auf den Button “Theme hinzufügen klicken”. Im neuen Fenster dann an derselben Position auf den Button “Theme hochladen” klicken und dann über “Choose File” die Theme-Datei auswählen und anschließend auf “Jetzt installieren” klicken.

## Child-Theme
Sofern ihr plant, dass Theme zu erweitern oder anzupassen, nutzt dafür das vorhandene Child-Theme. Damit bleiben Änderungen auch bei Updates am Haupt-Theme in eurer Instanz wirksam!

## Theme aktivieren
![Screenshot Theme aktivieren](/doc/theme-activate.png "Theme aktivieren")

Im Menüpunkt “Design” auf den Unterpunkt “Themes” klicken und dort das neu hinzugefügte Theme “WJD-Theme” aktivieren. 

## Plugins installieren
![Screenshot Plugins installieren](/doc/theme-plugin-installer-1.png "Plugins installieren")

Sobald das Theme aktiviert wurde erscheint oben ein neues Fenster, das über die benötigten Plugins informiert. Dort auf “Begin installing Plugins” klicken.

![Screenshot Plugins installieren](/doc/theme-plugin-installer-2.png "Plugins installieren")

Im neuen Fenster dann alle Häckchen ausfüllen und als Aktion “Install” auswählen. Beim Klick auf “Übernehmen” werden die Plugins dann installiert.

## Demo-Daten importieren
Falls noch nicht geschehen, einen beliebigen Menüpunkt auswählen, um das Menü mit den neuen Optionen der Plugins zu aktualisieren.
Anschließend beim Punkt “Design” auf den Unterpunkt “Import Demo Data” klicken und im neuen Fenster auf den “Import Demo Data” Button klicken.
Es sollten jetzt die Demo-Daten installiert werden und nach dem Abschluss bei den Seiten, Formularen, Projekten etc. sichtbar sein.

![Screenshot Demo-Daten importieren](/doc/import-demo-data.png "Demo-Daten importieren")

# Grundkonfiguration
Die Demo-Daten bieten eine solide Grundlage um mit dem Theme zu arbeiten. Im Folgenden gehen wir auf einige Aspekte der Grundkonfiguration ein.

## Seitentitel 
Der Titel der Website kann im Menü unter **Einstellungen** und dann beim Unterpunkt **Allgemein** festgelegt werden.
Alternativ auch über den **Customizer** unter dem Menüpunkt **Website-Informationen** (siehe nächster Abschnitt).

## Customizer (Logo / Favicon)
Auch Website-Logo (Bild im Header) und das Website-Icon (Bild zu sehen im Browser-Tab), auch Favicon genannt, lassen sich über den **Customizer** anpassen.
Dieser muss zunächst aufgerufen bzw. gestartet werden.

Dazu wählt man im Menü den Punkt **Design** und anschließend den Unterpunkt **Customizer**.
Im Customizer kann man neben Logo und Icon auch noch andere Einstellungen treffen, die aber sonst auch über das normale Dashboard bearbeitet werden können.

Unter dem Customizer-Menüpunkt **Website-Informationen** lassen sich jetzt über zwei Schaltflächen Logo und Icon aus der Mediathek auswählen. Falls schon ein Website-Icon eingestellt wurde, gibt es an derselben Stelle stattdessen die Schaltfläche **Bild wechseln**.

![Screenshot Customizer](/doc/customizer-1.png "Customizer")

Für das Logo empfiehlt sich das Format SVG, für das Website-Icon PNG.

Klickt man auf einen der beiden Buttons öffnet sich anschließend die Mediathek, in der man dann das gewünschte Bild auswählt. Dieses kann nach dem Auswählen noch über den Button **Bild zuschneiden** zugeschnitten werden.

Dabei sollte man sich nach Möglichkeit an die voreingestellte Fenstergröße (der nicht ausgegraute Bereich) halten, damit das Bild an der entsprechenden Stelle auch richtig passt.

![Screenshot Customizer](/doc/customizer-2.png "Customizer")

Hinweis:
Nachdem ein Bild zugeschnitten wurde, wird es als neues/separates Bild gespeichert. Wenn man versucht, ein bereits zugeschnittenes oder zu kleines Bild neu zuzuschneiden, erscheint eine Fehlermeldung.

## Footer / Widgets
Um Widgets zu bearbeiten und einzufügen, muss man zunächst auf die entsprechende Seite navigieren. Diese befindet sich in der Seitenleiste unter **Design** und dann im Untermenü bei **Widgets**.

Im Abschnitt **Verfügbare Widgets** gibt es eine Auswahl der verschiedenen Widgets, die dann per Drag-and-Drop in die Kästen mit den entsprechenden Positionen gezogen werden. Dort erscheinen dann die Optionen zum Konfigurieren des Widgets.

![Screenshot Widgets](/doc/widgets.png "Widgets")

**Standard Konfiguration für Widgets:**
- Responsive Footer Column
  1.  Widget: Text
  Titel: leer
  Inhalt: ```[button type="tertiary" size="large"]Mitglied Werden[/button]```
- Footer Column 1
leer
- Footer Column 2
  1. Widget: Text
  Titel: leer
  Inhalt: ```[social_link type="facebook" url="https://www.facebook.com/Wirtschaftsjunioren" text="Facebook"]```
  2. Widget: Text
  Titel: leer
  Inhalt: ```[social_link type="twitter" url="https://twitter.com/WJDeutschland" text="Twitter"]```
- Footer Column 3
  1. Widget: Text
  Titel: Interesse geweckt?
  Inhalt: ```[button type="tertiary" size="large"]Mitglied werden[/button]```
  2. Widget: Text (optional)
  Titel: leer
  Inhalt: Zwei Partnerbilder
- Header Column Login
  1. Widget: Text
  Titel: leer
  Inhalt: ```[icon_link icon="sign-in" url="/xyz" text="login"]```
- Header Column CTA
  1. Widget: Text
  Titel: leer
  Inhalt: ```[button type="tertiary" size="large"]Mitglied werden[/button]```

## Menüs
Den Menü-Editor erreichen Sie in WordPress über die linke Seitenleiste. Klicken oder überfahren Sie mit der Maus den Menüpunkt **Design** und wählen Sie anschließend **Menüs** aus.

![Screenshot Menü](/doc/setup-menu-1.png "Menü")

Anschließend wird Ihnen der Menü-Editor angezeigt. Hier haben Sie die Möglichkeit, die zuvor importierte Menüstruktur zu bearbeiten und nach Belieben anzupassen. Sie können aber auch von Grund auf neu anfangen und ein Menü nach Ihrer Vorstellung erstellen.

![Screenshot Menü-Editor](/doc/setup-menu-2.png "Menü-Editor")

**Aufbau des Menü-Editors:**
1.	Unter diesem Tab haben Sie die Möglichkeit, ein Menü auszuwählen, ein neues Menü zu erstellen oder ein vorhandenes Menü zu bearbeiten.
2.	Unter diesem Tab haben Sie die Möglichkeit, die Menüanordnung zu verändern.
3.	Unter Ansicht anpassen können Sie verschiedene Elemente und Optionen für den Menü-Editor aktivieren. Sie können beispielsweise einen Eintrag in einem neuen Tab öffnen lassen oder verschiedene Beitragstypen dem Menü hinzufügen. 
So können etwa Projekte, Positionen, Kategorien, Veranstaltungen, etc. in das Menü platziert werden.
4.	Unter dem Punkt Hilfe erhalten Sie eine von WordPress bereitgestellte Hilfestellung.
5.	Hier können Sie ein Menü auswählen, welches Sie bearbeiten möchten.
6.	An dieser Stelle haben Sie die Möglichkeit, ein neues Menü anzulegen.
7.	Hier können Sie neue Menüeinträge hinzufügen. Wählen Sie dafür das gewünschte Element aus. Nach Klick auf eins der Elemente erscheinen weitere Einstellungen. Unter “Seiten” wählen Sie alle Seiten aus, die Sie im Menü platzieren möchten. Unter individuelle Links können Sie eine URL angeben, die z.B. auf eine andere Seite verweist.
8.	An dieser Stelle werden alle hinzugefügten Menüeinträge angezeigt. Diese können Sie per Drag & Drop anordnen, bearbeiten oder aber auch löschen. Sie können an dieser Stelle ebenso die Menüposition festlegen, das Menü umbenennen oder aber auch löschen.

**Untertitel / Beschreibung für Menüpunkte**
Es ist möglich, den Menüpunkten zusätzlich eine Beschreibung zu geben, die dann auch im Menü angezeigt wird.
Diese Funktion ist standardmäßig deaktiviert und muss erst aktiviert werden.

![Screenshot Menü-Editor](/doc/setup-menu-3.png "Menü-Editor")

Dazu klickt man im Menü-Editor ganz rechts oben auf der Seite auf **Ansicht anpassen** und wählt im sich aufklappenden Fenster bei **Erweiterte Menüeigenschaften anzeigen** die Checkbox für die **“Beschreibung”** aus.

Anschließend ist das neue Textfeld bei jedem Menüpunkt sichtbar.



# Einstieg in den Blockeditor
## Einführung
Der Block-Editor in WordPress ist das Herzstück der Anwendung. Mit diesem ist es möglich, mittels verschiedener Blöcke, den Seitenaufbau einfach und strukturiert zu erstellen oder zu bearbeiten.

Den Block-Editor finden Sie immer dann vor, wenn Sie eine Seite oder einen Beitrag erstellen oder bearbeiten. Wenn Sie zum ersten Mal eine Seite oder einen Beitrag anlegen, dann begrüßt Sie der Editor mit einem Willkommens-Guide, welcher im Groben die Funktionalität und den Umgang mit dem Block-Editor beschreibt.

![Screenshot Gutenberg](/doc/gutenberg.png "Gutenberg")

**Aufbau des Block-Editors:**
1.	Mit Klick auf das WordPress Logo gelangen Sie zurück zum Dashboard von WordPress und verlassen den Editor.
2.	Über das + - Icon können Sie Blöcke der Seite hinzufügen.
3.	Hier finden Sie schnell Aktionen, um etwa Änderungen rückgängig zu machen. Zudem können Sie hier zwischen den Block-Ansichten wechseln.
4.	Über diesen Button können Sie die Seite oder den Beitrag veröffentlichen.
5.	Über die drei Punkte gelangen Sie zu Einstellungen, die Ihnen ermöglichen, den Block-Editor vom Aussehen her anzupassen.
6.	Unter dem Punkt Seite finden Sie seitenspezifische Einstellungen, um etwa den Status der Seite (öffentlich oder privat) umzustellen oder um ein Beitragsbild festzulegen.
7.	Unter dem Punkt Block finden Sie, zum jeweils ausgewählten Block, unterschiedliche Einstellungen, um etwa die Schriftgröße oder -farbe anzupassen.
8.	In diesem Bereich finden Sie den Inhalt Ihrer Seite bzw. Ihres Beitrags. Neue Blöcke werden in diesem Bereich abgelegt und können dann bearbeitet werden.

## Blockbeschreibungen
### Text-Blöcke
| Block | Beschreibung | Backend | Frontend |
|---|---|---|---|
|**Sektion**|Der Block Sektion unterteilt die Seite in verschiedene Teile und wird benutzt, um Blöcke innerhalb einer Seite aufzuteilen. **Es müssen dabei immer alle anderen Blöcke, bis auf den Hero-Block, innerhalb einer Sektion sein.** Der Hero-Block zählt als eigene Sektion und wird daher nicht in eine Sektion verpackt.|||
|**Button**|Der Button fungiert als speziell gestylter Link. Es können Button-Text und Link definiert werden.||![Screenshot Button Frontend](/doc/button-frontend.png "Button Frontend")|
|**Karte, Beitrags-Karte und Projekte-Karte**|Mit diesem Block wird ein Fenster mit Bild, Text und verschiedenen anderen Informationen eingebunden. Bei “Karte” können diese Informationen direkt in den Block eingegeben werden. Bei Beiträgen oder Projekten gilt der Block als Vorschau, sieht aber gleich aus. Die Informationen sind dabei schon aus dem Beitrag oder Projekt festgelegt und können nicht mehr geändert werden. Zusätzlich gibt es noch ein Häkchen, mit dem man einen “Mehr lesen”-Button für die Vorschau aktivieren kann||![Screenshot Karte Frontend](/doc/card-frontend.png "Karte Frontend")|
|**Download**|Der Block Download gibt Ihnen die Möglichkeit, eine Datei wie etwa ein PDF-Dokument, als Download auf der Seite anzubieten. Laden Sie dafür die Datei in die Mediathek hoch und wählen Sie sie anschließend aus.|![Screenshot Download Backend](/doc/download-backend.png "Download Backend")|![Screenshot Download Frontend](/doc/download-frontend.png "Karte Frontend")|
|**Zitat**|Der Zitatblock gibt Ihnen die Möglichkeit, eine Aussage zu zitieren. Dieser Block wird auf der Seite entsprechend formatiert und Sie können zusätzlich die Person angeben, welche Sie zitieren möchten.||![Screenshot Zitat Frontend](/doc/quote-frontend.png "Zitat Frontend")|
|**Hero**|Der Hero-Block ist standardmäßig auf jeder Seite vorzufinden. Hier definieren Sie den Titel der Seite, einen Untertitel und können ein Headerbild festlegen. Es ist möglich, mehrere Bilder auszuwählen. Diese werden auf der Seite als Bild-Slider dargestellt.|![Screenshot Hero Backend](/doc/hero-backend.png "Hero Backend")||
|**Absatz**|Im Absatz-Block können Sie einen Textabschnitt definieren. In der Seitenleiste stehen Ihnen Optionen für die Schriftgröße oder Schriftfarbe zur Verfügung.|![Screenshot Absatz Backend](/doc/paragraph-backend.png "Absatz Backend")||
|**Überschrift**|Der Block Überschrift bietet Ihnen ein Feld, um eine Überschrift zu definieren. In der Seitenleiste finden Sie Optionen, um beispielsweise die Schriftgröße sowie Schriftfarbe anzupassen. Eine Überschrift sollte idealerweise vor einem Text stehen und einen aussagekräftigen Titel tragen.|![Screenshot Überschrift Backend](/doc/heading-backend.png "Überschrift Backend")||
|**Liste**|Der Listen-Block bietet Ihnen die Möglichkeit, eine Aufzählung verschiedener Standpunkte aufzustellen.|![Screenshot Liste Backend](/doc/list-backend.png "Liste Backend")||
|**Classic**|Der Inhalt dieses Blocks wird als klassischer Wordpress Inhalt gewertet. Mit klassisch ist hiermit ein veralteter Editor gemeint, in dem per HTML der Seiteninhalt geschrieben wurde. In diesem Editor lassen sich also HTML Code, Text sowie Shortcodes einfügen.|||

### Medien-Blöcke
**Bild, Galerie und Video**
Mit diesen 3 Blöcken lassen sich einzelne Bilder, Galerien oder Videos auf der Seite einfügen. Die Elemente müssen dabei zuerst in die Mediathek der Seite hochgeladen und dann innerhalb der Blocks ausgewählt werden.

### Design-Blöcke
**Spalten**
Die Spalten dienen zum Teilen des Layouts. Das Einfügen mehrerer Spalten teilt die Seite vertikal. Pro Spalte kann dann die Breite in Prozent angegeben werden. Dabei sollte beim Addieren der Werte immer am Ende 100% herauskommen. Also z.B. 33,3% / 66,6%

**Abstandshalter**
Der Abstandshalter macht nichts weiter, als einen Abstand zwischen dem darüber und dem darunter liegenden Block einzustellen. Er kann auch nicht weiter angepasst werden.


### Widgets-Blöcke

**Contact-Form-7**
Mit diesem Block wird ein Formular, welches mit Contact-Form-7 gebaut wurde, eingebunden.

![Screenshot Block Contact-Form-7](/doc/block-cform.png "Block Contact-Form-7")

**Formular (GravityForms)**
Über den Formular-Block lässt sich ein in GravityForms konfiguriertes Formular auf der Seite einfügen. Dabei muss das gewünschte Formular ausgewählt werden.

![Screenshot Block GravityForms](/doc/block-gravityform.png "Block GravityForms")

**Shortcodes**
Als Shortcode bezeichnet man einen in eckigen Klammern geschriebenen Code, der von WP als Befehl zum Ausgeben von bestimmten Inhalten interpretiert wird. Damit lassen sich z.B. verschiedene Events anzeigen. 

Beispiel:
```
[events_list category='internationales-kultur' limit=2][/events_list]
```

**Social-Icons**
Der Social-Icons-Block besteht selbst wiederum aus weiteren Mini-Blöcken, den eigentlichen Icons. Diese fügt man innerhalb des Blocks mit dem +-Button hinzu. Für diese lassen sich Labels und Links anpassen. Der gesamte Block hat auch mehrere Einstellungsmöglichkeiten wie Farbe, Position etc.

![Screenshot Liste Backend](/doc/block-social-icons.png "Liste Backend")

# Shortcodes
## Button
|Attribut|Werte|
|---|---|
|type|unbreakable, inverted, secondary, secondary-plain, tertiary, tertiary-plain, solid, inverted-solid, secondary-solid, secondary-solid-inverted, tertiary-solid, close, sharp|
|size|large, small, tiny, wide|

**Beispiel:**
```
[button type="tertiary" size="large"]Mitglied werden[/button]
```

## Social-Link
|Attribut|Werte|
|---|---|
|type|facebook, twitter, instagram, youtube, linkedin (vgl. fontawesome)|
|url|Beliebiger URL auf die verwiesen werden soll|
|text|Beliebiger Text welcher angezeigt werden soll|

**Beispiel:**
```
[social_link type="facebook" url="https://www.facebook.com/Wirtschaftsjunioren" text="Facebook"]
```

## Icon-Link
|Attribut|Werte|
|---|---|
|icon|Beliebiger Font-Awesome Icon Name, eine Liste mit allen Möglichkeiten finden Sie hier: https://fontawesome.com/icons|
|url|Beliebiger URL auf die verwiesen werden soll|
|text|Beliebiger Text welcher angezeigt werden soll|

**Beispiel:**
```
[icon_link icon="sign-in" url="/login" text="login"]
```

# Plugins

## Contact Form 7 (kostenfrei)

Ein Kontaktformular wird z.B. wie folgt erstellt:

```
[form_row type="radio" error-name="Anrede"][radio anrede use_label_element default:1 "Frau" "Herr"][/form_row]

[form_row label="Vorname*" error-name="Vorname"][text* namefirst][/form_row] [form_row label="Nachname*" error-name="Nachname"][text* namelast][/form_row] [form_row label="E-Mail*" error-name="E-Mail"][email* email][/form_row]				

[form_row label="Unternehmen/Organisation*" error-name="Unternehmen/Organisation"][text* enterprise][/form_row]

[form_row label="Position (optional)"][text position][/form_row]

[form_row label="Geburtsdatum" error-name="Geburtstadtum"][date* birthdate placeholder "tt.mm.jjjj"][/form_row]

[form_row label="Wunschkreis (Optional)"][select circle "- Nicht festgelegt/ausgewählt -" "Altmark" "Altötting" "Amberg-Sulzbach" "Anhalt-Bitterfeld"][/form_row]
 
[form_row label="Nachricht"][textarea message][/form_row]

[form_row type="checkbox" error-name="Datenschutzerklärung"][acceptance dsgvo] Ich akzeptiere die Datenschutzerklärung. [/acceptance][/form_row]

[form_row][submit "Senden"][/form_row]
```

Wie hier zu erkennen ist, muss jeder reguläre Input noch in einen [form_row] Shortcode gepackt werden.
 								
Dieser Shortcode kann die Parameter “type”, “label” und “error-name” annehmen. Type und Label sollten selbsterklärend sein. Type wird nur bei Checkboxen und Radio Inputs benötigt. Error-Name definiert die Ausgabe für die Fehlermeldungen im oberen Bereich. 
Alternativ lässt sich auch im Backend im Menüpunkt “Formular” (mit dem Brief-Icon) ein Formular anlegen. Man muss im Shortcode dann nur noch die ID aus dem Backend angeben z.B.: [contact-form-7 id="136460" title="Contact form 1"]. Den Shortcode inkl. ID kann man im Backend unter dem eben genannten Punkt finden.
Wenn ein Formular angelegt wurde, kann man zusätzlich auch den dafür vorgesehenen Block “Contact Form 7” verwenden. In diesem muss nur das gewünschte Formular ausgewählt werden.
Weitere Informationen (auf englisch): https://contactform7.com/docs/



## GravityForms (kostenpflichtig)

Um alle Funktionen von GravityForms Pro nutzen zu können, muss ein Lizenzschlüssel eingegeben werden.

GravityForms funktioniert ähnlich wie Contact Form 7. Im Backend gibt es für das Plugin ebenfalls einen Punkt “Formulare” (wenn man Contact Form 7 und GravityForms gleichzeitig installiert hat, kann das ein bisschen verwirrend sein). Mit dem Import sollten schon 2 Formulare angelegt worden sein. Es gibt folgenden Funktionen / Menüpunkte:

- Im Tab “Bearbeiten” lassen sich verschiedene Felder per Drag-and-Drop nach links in den Formularbereich ziehen und dort anpassen.
-	Der Tab “Einstellungen” hat vier weitere Menüs:
    -	Die “Formulareinstellungen” legen das grundlegende Design und Verhalten des Formulars fest.
    -	In den “Bestätigungen” kann festgelegt werden, welche Nachricht nach dem Absenden des Formulars angezeigt wird.
    -	“Benachrichtigungen” betrifft die verschiedenen Mails, die nach dem Ausfüllen abgeschickt werden. Dabei kann man sowohl den Empfänger als auch den Seitenbesucher mit verschiedenen Nachrichten angeben.
    - Bei den “Personenbezogenen” Daten lassen sich noch zusätzliche Einstellungen zur Speicherung eben dieser treffen.
-	Im Bereich “Einträge” kann man die Daten von allen bisher abgeschickten Feldern einsehen und nach Bedarf auch erneut Benachrichtigungen verschicken.
-	Mit der “Vorschau” kann man sich eine grobe Vorschau des Formulars anzeigen lassen.

Um die Formulare auf einer Seite anzeigen zu lassen, wählt man im Block-Editor den Block “Formular” im Bereich “Einbettungen”, siehe Abschnitt “Einstieg in den Block-Editor” -> “Einbettungen-Blöcke” 

Weitere Informationen (auf englisch): https://docs.gravityforms.com/


## My Calendar (kostenfrei)
Für das My Calendar Plugin müssen einige Einstellungen getroffen werden, nachdem das Plugin installiert wurde.			
- Unter **Kategorien verwalten** sollten die entsprechenden Kategorien, die benötigt werden, erstellt und mit Farben versehen werden.
- Im Style-Editor das Häkchen bei **Die My Calendar Styledatei deaktivieren** setzen
- In den **Einstellungen > Allgemein** die Hauptkalender-Seiten-ID auf die Seite der Events setzen.
- In den **Einstellungen > Text**
  - den Veranstaltungstitel (Kacheln) auf **{title}** setzen
  - den Veranstaltungstitel (Einzeln) auf **{title}** setzen
  - den Veranstaltungstitel (Liste) auf **{title}** setzen
  - das Label für Ganztages Veranstaltungen auf **Ganztags** setzen
  - das Primary Date Format auf “**j. F Y**” setzen
  - das Datum im Kachelmodus in der Wochenansicht auf ”**j**“ setzen			 			
- In den Einstellungen > Ausgabe
  - das Häkchen bei **Open calendar links to event details** setzen
  - **Reihenfolge des Kalenderlayouts wie folgt setzen:**			
    - Primäre vor/zurück Schaltflächen
    - Schalte zwischen Tages-, Wochen und Monatsansicht um
    - Der Kalender
    - Rest in beliebiger Reihenfolge unter den schwarzen Balken Elements below here will be hidden ziehen	

Danach kann der Kalender mit dem Shortcode ```[my_calendar]``` eingebunden werden

Weitere Informationen (auf Englisch): https://docs.joedolson.com/my-calendar/		

## Events Manager (kostenpflichtig)

### Allgemein
Das Plugin Events-Manager ist unter dem Menüpunkt “Veranstaltungen” zu finden.

![Screenshot Veranstaltungen](/doc/events-1.png "Veranstaltungen")

- Eine Übersicht über alle angelegten Veranstaltungen gibt es im Menüpunkt “Veranstaltungen”. Von dort aus können auch die weiteren Funktionen des entsprechenden Events ausgewählt werden bzw. Events bearbeitet werden.
- Unter dem Menüpunkt “Veranstaltungen hinzufügen” lassen sich neue Veranstaltungen anlegen.
- “Veranstaltungsschlagworte“ und “Veranstaltungskategorien” lassen sich anlegen, um die Events zu gruppieren bzw. einzuordnen. Über diese beiden Menüpunkte kann man diese einsehen und bearbeiten. Beim Anlegen oder Bearbeiten einer Veranstaltung werden diese dann zugeordnet.
- Für die Veranstaltungsorte gilt dasselbe wie für die Kategorien und Schlagworte. Diese werden ebenfalls beim Anlegen von Veranstaltungen angelegt bzw. zugeordnet.
- “Wiederkehrende Veranstaltungen” sind praktisch identisch zu den normalen Veranstaltungen. Es gibt lediglich ein neues Feld, in das man eingibt, nach welcher Zeitspanne die Veranstaltung wieder stattfindet.
- Hat man seiner Veranstaltung eine Buchung zugefügt, so kann man sich beim Punkt “Buchungen” alle Einträge anschauen.
- In den “Einstellungen” werden verschiedene generelle Einstellungen für das Plugin getroffen.
- Im “Formulareditor” werden die Anmelde- und Buchungsformulare angepasst, die bei Bedarf einem Event hinzugefügt werden können.
- Die “Zahlungs-Gateways” bestimmen die Zahlungsoptionen und die Zahlungsweise der Buchungsformulare. Alle Einstellungen dazu können hier getätigt werden.
- In der “Gutscheinverwaltung” werden Gutscheine für die Buchungen angelegt. Hat eine Veranstaltung, die einen gültigen Gutschein besitzt, einen Preis, dann wird automatisch ein Gutscheinfeld angezeigt, in das die Gutscheincodes eingetragen werden können.

### Event anlegen

![Screenshot Veranstaltungen](/doc/events-2.png "Veranstaltungen")

1.	Hier wird der Titel der Veranstaltung eingegeben.
2.	Veranstaltungsbeschreibung, Informationen etc. werden hier eingegeben.
3.	Der Typ des Veranstaltungsortes wird hier eingegeben. Je nach Typ gibt es verschiedene Optionen.
4.	Kreuzt man das Häkchen an, wird ein zuvor erstelltes Buchungsformular für die Veranstaltung aktiviert. Die zugehörigen Einstellungen klappen dann auf.
5.	Hier kann man einen Zeitpunkt für die Veranstaltung festlegen.
6.	Hier kann man die Schlagworte eingeben.
7.	Hier kann man verschiedene Kategorien auswählen.
8.	Unterhalb lässt sich das Beitragsbild festlegen.

### Shortcodes
Events haben automatisch eine eigene Seite, auf die per Link weitergeleitet werden kann.
Es gibt aber auch die Möglichkeit, eine kleine Vorschau auf einer Seite einzufügen.

Dazu wird der Block Shortcode ausgewählt und dort dann die Shortcodes eingefügt (siehe Abschnitt Block-Editor).

Für eine Liste von Events wird der Shortcode event_list benutzt.

```
[events_list limit="10" location="restaurant-zum-hirschen" category='adventurebox-karlsruhe']
```

Mit dem Parameter limit lässt sich die maximale Anzahl an Events einstellen.
Parameter location gibt den Veranstaltungsort an und gibt damit nur noch Events an diesem Standort aus.
Dasselbe lässt sich auch noch mit den Kategorien machen, hier heißt der Parameter category.

Zu beachten ist hier, dass bei category die Titelform der Kategorie benutzt werden muss. Diese kann man in der Übersicht der Kategorien sehen.
Beim Standort muss es die korrekte URL-Version sein. Diese lässt sich beim Bearbeiten des entsprechenden Ortes als letzte Zeichenkette der URL auslesen:

![Screenshot Veranstaltungen](/doc/events-3.png "Veranstaltungen")

Um nur eine Event-Vorschau anzeigen zu lassen, benutzt man den Shortcode event.

```
[event post_id="135918"]
```

Hier muss als Parameter die ID des Events eingegeben werden.

Diese lässt sich in der URL ablesen, wenn man gerade eine Veranstaltung anlegt / bearbeitet:

![Screenshot Veranstaltungen](/doc/events-4.png "Veranstaltungen")

Bei beiden Shortcodes sieht die Vorschau des Events dann ungefähr so aus:

![Screenshot Veranstaltungen](/doc/events-5.png "Veranstaltungen")

Weitere Informationen (auf Englisch): https://wp-events-plugin.com/documentation/

## One-Click-Demo-Import
Dieses Plugin ermöglicht es, per Button, verschiedene Demo Daten in WordPress einzufügen.
Wenn das Plugin eingerichtet wurde, muss man lediglich im WP-Menü auf “Design” -> “Import Demo Data” gehen und dort den Button “Import Demo Data” anklicken. Nach einigen Sekunden ist der Vorgang abgeschlossen und die neuen Inhalte auf der Seite sichtbar. Siehe auch Abschnitt oben “Installation”.

**Konfiguration (für Entwickler):**
Die hier beschriebene Konfiguration bezieht sich auf den aktuellen Stand des WJ-Themes. In anderen Themes sind die entsprechenden Filter an unterschiedlichen Stellen zu finden.

- Im Theme ist das Plugin aktuell so eingestellt, dass die gesamten Import-Informationen aus einer Datei kommen: /demo-import/demo-data.xml. In dieser Datei kann man die importierten Daten im XML-Format angeben. Das geht am leichtesten, indem man in einem bestehenden WP im Menü die Funktion “Werkzeuge” -> “Daten Exportieren” aufruft und dort die entsprechenden Daten als XML-Datei abspeichert. Den Inhalt der Datei kann man dann in die demo-data.xml einfügen.
- Eine zusätzliche Konfiguration lässt sich in der  /demo-import/demo-data.php anpassen. Dort werden nach dem Import die importierten Menüs an die entsprechende Position gesetzt und die Start- und Beitragsseite gesetzt.

Weitere Informationen (auf englisch): https://github.com/awesomemotive/one-click-demo-import

# Entwickler-Dokumentation
## Ordnerstruktur
- Calendar > Alle Erweiterungen zu Plugins ein eigenem Folder
- Core > Alle Basisfunktionen (hier würde ich dein Code sehen)
- Shortcodes > Basisshortcodes oder nach Plugins geteilt
- TemplatePart > Teile von Inhalten (MenuWalker bisher, falls nötig content Templates...)
- Utility > Alles was kleine Teile zur Erweiterung von Templates sind
- templates > Alles was mit WP Templating zu tun hat (Inhalte index.php ...)