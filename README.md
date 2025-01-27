# OpenSim.RemoteAdmin.2025

## OpenSimulator Console Command Interface

Dieses Projekt bietet eine benutzerfreundliche Weboberfläche, um Remote-Console-Befehle an einen OpenSimulator-Server zu senden. Es wurde speziell entwickelt, um die Verwaltung und Steuerung eines OpenSimulator-Servers zu erleichtern.

---

## 📋 Features

- **Senden von Remote-Befehlen:** 
  Führen Sie OpenSimulator-Serverbefehle über die RemoteAdmin-API aus.
- **Benutzerfreundliches Formular:**
  Einfaches Eingabefeld für die IP, Port, Passwort, Befehl und Parameter.
- **Statusanzeige:**
  Erfolgs- und Fehlermeldungen basierend auf der Serverantwort.
- **Automatischer Redirect:** 
  Rückkehr zur Hauptseite nach erfolgreicher Ausführung eines Befehls.

---

## 🛠️ Voraussetzungen

- **PHP 8.0 oder höher**
- Webserver wie Apache oder Nginx
- RemoteAdmin in der `OpenSim.ini`-Konfigurationsdatei aktiviert:
  ```ini
   [RemoteAdmin]
   enabled = true
   access_password = secret
   enabled_methods = all
  ```
---

## 🚀 Installation

1. **Clone das Repository:**
   ```bash
   git clone https://github.com/ManfredAabye/OpenSim.RemoteAdmin.2025.git
   cd opensimulator-console-interface
   ```
2. **Stelle sicher, dass dein OpenSimulator-Server läuft.**

---

## 🖥️ Nutzung

1. Öffne die Weboberfläche im Browser:
   ```bash
   http://localhost/ConsoleCommand.php
   ```

2. Fülle das Formular aus:
   - **OpenSim IP:** IP-Adresse des OpenSimulator-Servers.
   - **OpenSim Port:** Port des RemoteAdmin-Dienstes (Standard: `9000`).
   - **OpenSim Passwort:** Das Passwort für den RemoteAdmin-Zugang.
   - **OpenSim Command:** Der auszuführende Konsolenbefehl (z. B. `alert`).
   - **OpenSim Parameters:** Optionale Parameter für den Befehl.

3. Klicke auf **"Send OpenSim Command"**, um den Befehl auszuführen.

4. Bei Erfolg erscheint die Meldung:
   ```
   Command executed successfully.
   ```
   Die Seite kehrt nach 5 Sekunden zur Hauptoberfläche zurück.

---

## ⚠️ Hinweise

- **Fehlerbehebung:**
  - Stelle sicher, dass die IP des Servers und der Port des OpenSimulators korrekt sind.
  - Überprüfe, ob der RemoteAdmin-Dienst im OpenSimulator korrekt konfiguriert ist.
- **Sicherheitsaspekt:**
  - Halte das Passwort für den RemoteAdmin-Zugang geheim und beschränke den Zugriff auf das Webinterface.

---

## 🧩 Lizenz

Dieses Projekt steht unter der **MIT-Lizenz**. Weitere Informationen findest du in der Datei [LICENSE](LICENSE).

---

## 📞 Support

Bei Fragen oder Problemen kannst du ein Issue auf GitHub erstellen oder dich an die OpenSimulator-Community wenden:

- [OpenSimulator-Wiki](http://opensimulator.org/wiki)

---

Viel Spaß beim Verwalten deines OpenSimulator-Servers! 🚀
```
