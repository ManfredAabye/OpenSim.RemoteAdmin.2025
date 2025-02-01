<!DOCTYPE html>
<?php
session_start(); // Sitzung starten

/*
 * ConsoleCommand.php (2025) Created under PHP 8.3
 *
 * @author Manfred Zainhofer
 * @copyright Copyright (c) 2025, OpenSim Community.
 * @license MIT License
 * @version 2.2.11
 * @link https://github.com/OpenSimCommunity/osConsoleCommand
 */
?>
<?php
// Debug-Modus aktivieren (true) oder deaktivieren (false)
define('DEBUG_MODE', true); // Nur für Entwicklungszwecke auf true setzen

session_start([
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'use_strict_mode' => true
]);

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (isset($_POST['logout'])) {
    $_SESSION = [];
    session_destroy();
    echo '<p style="color: green;">Session beendet.</p>';
    echo '<meta http-equiv="refresh" content="2; URL=./ConsoleCommand.php">';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['telefon'])) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('CSRF validation failed.');
    }

    $OpenSim_IP = filter_var(trim($_POST['OpenSim_IP']), FILTER_VALIDATE_IP);
    $OpenSim_Port = filter_var(trim($_POST['OpenSim_Port']), FILTER_VALIDATE_INT);
    $OpenSim_Password = $_POST['OpenSim_Password'];
    $OpenSim_Command = htmlspecialchars(trim($_POST['OpenSim_Command']));
    $OpenSim_Params = htmlspecialchars_decode(trim($_POST['OpenSim_Params']));

    if (!$OpenSim_IP || !$OpenSim_Port || !preg_match('/^[a-zA-Z0-9_\-\s]+$/', $OpenSim_Command)) {
        echo '<p style="color: red;">Invalid input.</p>';
    } else {
        $remoteAdminPath = __DIR__ . '/RemoteAdmin.php';
        if (file_exists($remoteAdminPath)) {
            include($remoteAdminPath);
            $myRemoteAdmin = new RemoteAdmin($OpenSim_IP, $OpenSim_Port, $OpenSim_Password);

            $parameters = ['command' => $OpenSim_Command . ' ' . $OpenSim_Params];

            if ($myRemoteAdmin->SendCommand('admin_console_command', $parameters)) {
                echo '<p style="color: green;">Command executed successfully. Redirecting in <span id="countdown">5</span> seconds...</p>';
                
                // Debug-Ausgabe, wenn DEBUG_MODE aktiviert ist
                if (DEBUG_MODE) {
                    echo '<pre style="background: #f0f0f0; padding: 10px; border: 1px solid #ccc;">';
                    echo "Debug Information:\n";
                    echo "IP: " . htmlspecialchars($OpenSim_IP) . "\n";
                    echo "Port: " . htmlspecialchars($OpenSim_Port) . "\n";
                    echo "Command: " . htmlspecialchars($OpenSim_Command) . "\n";
                    echo "Params: " . htmlspecialchars($OpenSim_Params) . "\n";
                    echo '</pre>';
                }

                echo '<meta http-equiv="refresh" content="5; URL=./ConsoleCommand.php">';
                echo '<script>
                    let countdown = 5;
                    const interval = setInterval(() => {
                        countdown--;
                        document.getElementById("countdown").textContent = countdown;
                        if (countdown <= 0) clearInterval(interval);
                    }, 1000);
                </script>';
                exit();
            }
        } else {
            die('RemoteAdmin.php not found.');
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>OS Console</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="ConsoleCommand.css">
</head>
<body>
<div class="container console-container">
    <h1>OpenSimulator Console Commands</h1>
    <form action="" method="post">
        <input type="hidden" name="telefon" value="1" />
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        
        <div class="input-group">
            <label for="OpenSim_IP">OpenSim IP:</label>
            <input type="text" id="OpenSim_IP" name="OpenSim_IP" placeholder="OpenSim IP" value="<?php echo isset($_SESSION['OpenSim_IP']) ? htmlspecialchars($_SESSION['OpenSim_IP']) : ''; ?>" required>
        </div>
        
        <div class="input-group">
            <label for="OpenSim_Port">OpenSim Port:</label>
            <input type="text" id="OpenSim_Port" name="OpenSim_Port" placeholder="OpenSim Port" value="<?php echo isset($_SESSION['OpenSim_Port']) ? htmlspecialchars($_SESSION['OpenSim_Port']) : ''; ?>" required>
        </div>
        
        <div class="input-group">
            <label for="OpenSim_Password">OpenSim Password:</label>
            <input type="password" id="OpenSim_Password" name="OpenSim_Password" placeholder="OpenSim Password" required>
        </div>
        
        <div class="input-group">
            <label for="OpenSim_Command">OpenSim Command:</label>
            <input type="text" id="OpenSim_Command" name="OpenSim_Command" placeholder='command' value="<?php echo isset($_SESSION['OpenSim_Command']) ? htmlspecialchars($_SESSION['OpenSim_Command']) : ''; ?>" required>
        </div>
        
        <div class="input-group">
            <label for="OpenSim_Params">OpenSim Parameters:</label>
            <input type="text" id="OpenSim_Params" name="OpenSim_Params" placeholder='parameter' value="<?php echo isset($_SESSION['OpenSim_Params']) ? htmlspecialchars($_SESSION['OpenSim_Params']) : ''; ?>">
        </div>

        <div class="input-group">
            <button class="btn" type="submit" name="submit">Send OpenSim Command</button>
            <button class="btn reset" type="reset" name="Reset">Data Reset</button>
            <button class="btn logout" type="submit" name="logout">Session Close</button>
        </div>
        <a href="https://opensimulator.org/wiki/Server_Commands">
        <img src="flags/En.png" alt="English Flag" style="width:20px; height:15px;">
        What are server commands?
        </a></br>
        <a href="https://opensimulator.org/wiki/Server_Commands/de">
        <img src="flags/De.png" alt="German Flag" style="width:20px; height:15px;">
        Was sind Konsolenbefehle?
        </a></br>
        <a href="https://opensimulator.org/wiki/Server_Commands/fr">
        <img src="flags/Fr.png" alt="French Flag" style="width:20px; height:15px;">
        Que sont les commandes serveur ?
        </a></br>
        <a href="https://opensimulator.org/wiki/Server_Commands/ja">
        <img src="flags/Jp.png" alt="Japanese Flag" style="width:20px; height:15px;">
        サーバコマンドについて
        </a></br>
        <a href="https://opensimulator.org/wiki/Server_Commands/ru">
        <img src="flags/Ru.png" alt="Russian Flag" style="width:20px; height:15px;">
        Что такое консольные команды сервера?
        </a>
    </form>
</div>
</body>
</html>
