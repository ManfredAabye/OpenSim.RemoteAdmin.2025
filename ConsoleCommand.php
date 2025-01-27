<!DOCTYPE html>
<?php
/*
 * ConsoleCommand.php (2025) Created under PHP 8.3
 *
 * @author Manfred Zainhofer
 * @copyright Copyright (c) 2025, OpenSim Community.
 * @license MIT License
 * @version 1.2
 * @link https://github.com/OpenSimCommunity/osConsoleCommand
 */
?>
<html>
<head>
    <meta charset="utf-8">
    <title>OS Console</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="ConsoleCommand.css">
</head>
<body>

<div class="container">
    <h1>OpenSimulator Console Commands</h1>

    <?php if (!isset($_POST['telefon'])): ?>
        <!-- Eingabeformular -->
        <form action="" method="post">
            <input type="hidden" name="telefon" value="1" />
            
            <div class="input-group">
                <label for="OpenSim_IP">OpenSim IP:</label>
                <input type="text" id="OpenSim_IP" name="OpenSim_IP" placeholder="OpenSim IP" required>
            </div>
            
            <div class="input-group">
                <label for="OpenSim_Port">OpenSim Port:</label>
                <input type="text" id="OpenSim_Port" name="OpenSim_Port" placeholder="OpenSim Port" required>
            </div>
            
            <div class="input-group">
                <label for="OpenSim_Password">OpenSim Password:</label>
                <input type="password" id="OpenSim_Password" name="OpenSim_Password" placeholder="OpenSim Password" required>
            </div>
            
            <div class="input-group">
                <label for="OpenSim_Command">OpenSim Command:</label>
                <input type="text" id="OpenSim_Command" name="OpenSim_Command" placeholder='command' required>
            </div>
            
            <div class="input-group">
                <label for="OpenSim_Params">OpenSim Parameters:</label>
                <input type="text" id="OpenSim_Params" name="OpenSim_Params" placeholder='parameter'>
            </div>

            <div class="input-group">
                <button class="btn" type="submit" name="submit">Send OpenSim Command</button>
                <button class="btn reset" type="reset" name="Reset">Data Reset</button>
            </div>
            <a href="http://opensimulator.org/wiki/Server_Commands">
            <img src="flags/En.png" alt="English Flag" style="width:20px; height:15px;">
            What are server commands?
            </a></br>
            <a href="http://opensimulator.org/wiki/Server_Commands/de">
            <img src="flags/De.png" alt="German Flag" style="width:20px; height:15px;">
            Was sind Konsolenbefehle?
            </a></br>
            <a href="http://opensimulator.org/wiki/Server_Commands/fr">
            <img src="flags/Fr.png" alt="French Flag" style="width:20px; height:15px;">
            Que sont les commandes serveur ?
            </a></br>
            <a href="http://opensimulator.org/wiki/Server_Commands/ja">
            <img src="flags/Jp.png" alt="Japanese Flag" style="width:20px; height:15px;">
            サーバコマンドについて
            </a></br>
            <a href="http://opensimulator.org/wiki/Server_Commands/ru">
            <img src="flags/Ru.png" alt="Russian Flag" style="width:20px; height:15px;">
            Что такое консольные команды сервера?
            </a>
        </form>
    <?php else: ?>
        <?php
        // Eingaben auswerten und senden
        function senden()
        {
            if (isset($_POST['telefon']) && $_POST['telefon'] == 1) {
                // Eingaben bereinigen
                $OpenSim_IP = filter_var(trim($_POST['OpenSim_IP']), FILTER_VALIDATE_IP);
                $OpenSim_Port = filter_var(trim($_POST['OpenSim_Port']), FILTER_VALIDATE_INT);
                $OpenSim_Password = $_POST['OpenSim_Password'];
                $OpenSim_Command = htmlspecialchars(trim($_POST['OpenSim_Command']));
                $OpenSim_Params = htmlspecialchars_decode(trim($_POST['OpenSim_Params'])); // HTML-Entitäten zurückwandeln

                if (!$OpenSim_IP || !$OpenSim_Port) {
                    echo '<p style="color: red;">Invalid IP or Port.</p>';
                    return;
                }

                // RemoteAdmin-Klasse einbinden und verwenden
                include('RemoteAdmin.php');
                $myRemoteAdmin = new RemoteAdmin($OpenSim_IP, $OpenSim_Port, $OpenSim_Password);

                // Befehl und Parameter zusammenführen
                $parameters = ['command' => $OpenSim_Command . ' ' . $OpenSim_Params];

                // Befehl senden
                if ($myRemoteAdmin->SendCommand('admin_console_command', $parameters)) {
                    echo '<p style="color: green;">Command executed successfully. Redirecting in <span id="countdown">5</span> seconds...</p>';
                    echo '<meta http-equiv="refresh" content="5; URL=./ConsoleCommand.php">';
                    echo '<script>
                        let countdown = 5;
                        const interval = setInterval(() => {
                            countdown--;
                            document.getElementById("countdown").textContent = countdown;
                            if (countdown <= 0) clearInterval(interval);
                        }, 1000);
                    </script>';
                }
            }
        }


        // Funktion aufrufen
        senden();
        ?>
    <?php endif ?>  
</div>

</body>
</html>