<img src="https://github.com/ManfredAabye/OpenSim.RemoteAdmin.2025/blob/main/flags/En.png?raw=true" alt="Project Badge"> <img src="https://github.com/ManfredAabye/OpenSim.RemoteAdmin.2025/blob/main/flags/De.png?raw=true" alt="Project Badge">
# OpenSim.RemoteAdmin.2025

## OpenSimulator Console Command Interface

This project offers a user-friendly web interface to send various commands to an OpenSimulator server using `admin_console_command`. It is specifically designed to facilitate the management and control of an OpenSimulator server.

---

## 📋 Features

- **Sending Remote Commands:**
  Execute OpenSimulator server commands via the RemoteAdmin API.
- **User-Friendly Form:**
  Simple input fields for IP, port, password, command, and parameters.
- **Status Display:**
  Success and error messages based on server response.
- **Automatic Redirect:**
  Return to the main page after successful command execution.
- **Security:**
  Significant security improvements in version 1.2.
- **Future:**
  When `admin_console_command` receives response feedback in the future, OpenSim.RemoteAdmin.2025 will be ready to display it.

---

## 🛠️ Requirements

- **PHP 8.0 or higher**
- Web server like Apache or Nginx
- RemoteAdmin enabled in the `OpenSim.ini` configuration file:
  ```ini
   [RemoteAdmin]
   enabled = true
   access_password = secret
   enabled_methods = all
  ```
  (Please change the password "secret" and use a strong password of at least 12 characters with uppercase, lowercase, and special characters.)
---

## 🚀 Installation

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/ManfredAabye/OpenSim.RemoteAdmin.2025.git
   cd OpenSim.RemoteAdmin.2025
   ```
      
3. **Ensure your OpenSimulator server is running.**

---

## 🖥️ Usage

1. Open the web interface in your browser:
   ```bash
   http://localhost/ConsoleCommand.php
   ```

2. Fill out the form:
   - **OpenSim IP:** IP address of the OpenSimulator server (e.g., `192.168.2.1`).
   - **OpenSim Port:** Port of the RemoteAdmin service (e.g., `9000`).
   - **OpenSim Password:** The password for RemoteAdmin access (e.g., `qR>H-&u9A2kVs@Yt`). 
   - **OpenSim Command:** The console command to execute (e.g., `alert`).
   - **OpenSim Parameters:** Optional parameters for the command (e.g., `"Hello World"`).

3. Click **"Send OpenSim Command"** to execute the command.

4. On success, the message will appear:
   ```
   Command executed successfully.
   ```
   The page will return to the main interface after 5 seconds.

---

## ⚠️ Notes

- **Troubleshooting:**
  - Ensure the server's IP address and the OpenSimulator port are correct.
  - Verify that the RemoteAdmin service is correctly configured in OpenSimulator.
- **Security Aspect:**
  - Keep the password for RemoteAdmin access secret and restrict access to the web interface.

---

## 🧩 License

This project is under the **MIT License**. For more information, see the [LICENSE](LICENSE) file.

---

## 📞 Support

For questions or issues, you can create an issue on GitHub or reach out to the OpenSimulator community:

- [OpenSimulator Wiki](http://opensimulator.org/wiki)

---

Have fun managing your OpenSimulator server! 🚀

---

# OpenSim.RemoteAdmin.2025

## OpenSimulator Console Command Interface

Dieses Projekt bietet eine benutzerfreundliche Weboberfläche, um mit admin_console_command eine vielzahl von Befehle an einen OpenSimulator Server zu senden. Es wurde speziell entwickelt, um die Verwaltung und Steuerung eines OpenSimulator-Servers zu erleichtern.

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
- **Sicherheit:**
  In der Version 1.2 wurde stark an der Sicherheit gearbeitet.
- **Zukünftig:**
  Wenn in der Zukunft admin_console_command eine Response rückmeldung erhält wird OpenSim.RemoteAdmin.2025 bereit sein diese anzuzeigen.

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
  (Bitte ändern sie das Passwort "secret" und benutzen sie ein starkes mindestens 12 stelliges Passwort mit Groß und kleinschreibung sowie Sonderzeichen.)
---

## 🚀 Installation

1. **Clone das Repository:**
   ```bash
   git clone https://github.com/ManfredAabye/OpenSim.RemoteAdmin.2025.git
   cd OpenSim.RemoteAdmin.2025
   ```
      
3. **Stelle sicher, dass dein OpenSimulator-Server läuft.**

---

## 🖥️ Nutzung

1. Öffne die Weboberfläche im Browser:
   ```bash
   http://localhost/ConsoleCommand.php
   ```

2. Fülle das Formular aus:
   - **OpenSim IP:** IP-Adresse des OpenSimulator-Servers (z. B. `192.168.2.1`).
   - **OpenSim Port:** Port des RemoteAdmin-Dienstes (z. B. `9000`).
   - **OpenSim Passwort:** Das Passwort für den RemoteAdmin-Zugang (z. B. `qR>H-&u9A2kVs@Yt`). 
   - **OpenSim Command:** Der auszuführende Konsolenbefehl (z. B. `alert`).
   - **OpenSim Parameters:** Optionale Parameter für den Befehl (z. B. `"Hello World"`).

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
