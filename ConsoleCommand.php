<!DOCTYPE html>
<?php
/*
 * ConsoleCommand.php (2025) Created under PHP 8.3
 *
 * @author Manfred Zainhofer
 * @copyright Copyright (c) 2025, OpenSim Community.
 * @license MIT License
 * @version 1.0
 * @link https://github.com/OpenSimCommunity/osConsoleCommand
 */
?>
<html>
<head>
    <meta charset="utf-8">
    <title>OS Console</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .input-group {
            margin: 15px 0;
        }
        .input-group label {
            display: block;
            margin-bottom: 5px;
        }
        .input-group input, .input-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .btn.reset {
            background-color: #f44336;
        }
        .btn.reset:hover {
            background-color: #da190b;
        }
    </style>
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
                <input type="text" id="OpenSim_IP" name="OpenSim_IP" placeholder="OpenSim IP">
            </div>
            
            <div class="input-group">
                <label for="OpenSim_Port">OpenSim Port:</label>
                <input type="text" id="OpenSim_Port" name="OpenSim_Port" placeholder="OpenSim Port">
            </div>
            
            <div class="input-group">
                <label for="OpenSim_Password">OpenSim Password:</label>
                <input type="password" id="OpenSim_Password" name="OpenSim_Password" placeholder="OpenSim Password">
            </div>
            
            <div class="input-group">
                <label for="OpenSim_Command">OpenSim Command:</label>
                <input type="text" id="OpenSim_Command" name="OpenSim_Command" placeholder='command'>
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
            <img src="flags/En.png" alt="Germany Flag" style="width:20px; height:15px;">
            What are server commands?
            </a></br>
            <a href="http://opensimulator.org/wiki/Server_Commands/de">
            <img src="flags/De.png" alt="Germany Flag" style="width:20px; height:15px;">
            Was sind Konsolenbefehle?
            </a></br>
            <a href="http://opensimulator.org/wiki/Server_Commands/fr">
            <img src="flags/Fr.png" alt="Germany Flag" style="width:20px; height:15px;">
            Que sont les commandes serveur ?
            </a></br>
            <a href="http://opensimulator.org/wiki/Server_Commands/ja">
            <img src="flags/Jp.png" alt="Germany Flag" style="width:20px; height:15px;">
            サーバコマンドについて
            </a></br>
            <a href="http://opensimulator.org/wiki/Server_Commands/ru">
            <img src="flags/Ru.png" alt="Germany Flag" style="width:20px; height:15px;">
            Что такое консольные команды сервера?
            </a>
        </form>
    <?php endif ?>  
</div>

<?php
// Eingaben auswerten und senden
function senden() 
{
    if (isset($_POST['telefon']) && $_POST['telefon'] == 1)
    {
        // Eingaben bereinigen
        $OpenSim_IP = trim($_POST['OpenSim_IP']);
        $OpenSim_Port = trim($_POST['OpenSim_Port']);
        $OpenSim_Password = $_POST['OpenSim_Password'];
        $OpenSim_Command = trim($_POST['OpenSim_Command']);
        $OpenSim_Params = trim($_POST['OpenSim_Params']);

        // RemoteAdmin-Klasse einbinden und verwenden
        include('RemoteAdmin.php');
        $myRemoteAdmin = new RemoteAdmin($OpenSim_IP, $OpenSim_Port, $OpenSim_Password);
        
        // Befehl und Parameter zusammenführen
        $command_with_params = $OpenSim_Command . ' ' . $OpenSim_Params;
        $parameters = ['command' => $command_with_params];

        // Befehl senden
        $myRemoteAdmin->SendCommand('admin_console_command', $parameters);
        
        // Seite neu laden
        echo '<meta http-equiv="refresh" content="0; URL=./ConsoleCommand.php">';
    }
}

// Funktion aufrufen
senden();
?>

</body>
</html>
