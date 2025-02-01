<?php
/*
 * RemoteAdmin.php (2025) Created under PHP 8.3
 *
 * @author Manfred Zainhofer
 * @copyright Copyright (c) 2025, OpenSim Community.
 * @license MIT License
 * @version 1.2
 * @link https://github.com/OpenSimCommunity/osConsoleCommand
 */
class RemoteAdmin
{
    private string $simulatorURL;
    private string $simulatorPort;
    private string $password;

    public function __construct(string $sURL, string $sPort, string $pass)
    {
        $this->simulatorURL = $sURL;
        $this->simulatorPort = $sPort;
        $this->password = $pass;
    }

    public function SendCommand(string $command, array $params = []): bool
    {
        $xml = $this->buildXML($command, $params);

        // Verbindung zum Server herstellen
        $fp = @fsockopen($this->simulatorURL, $this->simulatorPort, $errno, $errstr, 5);
        if (!$fp) {
            echo '<p style="color: red;">Failed to connect: ' . htmlspecialchars($errstr) . ' (' . htmlspecialchars($errno) . ')</p>';
            return false;
        }

        // Anfrage senden
        if (!$this->sendRequest($fp, $xml)) {
            fclose($fp);
            echo '<p style="color: red;">Failed to send request.</p>';
            return false;
        }

        // Antwort vom Server empfangen
        $response = $this->getResponse($fp);
        fclose($fp);

        // Überprüfe den HTTP-Statuscode
        if (strpos($response, 'HTTP/1.1 200 OK') !== false) {
            echo '<p style="color: green;">Command executed successfully.</p>';
            // Optionale Ausgabe der vollständigen Antwort
            echo '<pre>Response: ' . htmlspecialchars($response) . '</pre>';
            return true;
        } else {
            echo '<p style="color: red;">Server returned a non-200 status code.</p>';
            echo '<pre>Response: ' . htmlspecialchars($response) . '</pre>';
            return false;
        }
    }

    private function buildXML(string $command, array $params): string
    {
        $xml = '<methodCall>
                    <methodName>' . htmlspecialchars($command) . '</methodName>
                    <params>
                        <param>
                            <value>
                                <struct>
                                    <member>
                                        <name>password</name>
                                        <value><string>' . htmlspecialchars($this->password) . '</string></value>
                                    </member>';
        foreach ($params as $name => $value) {
            $xml .= '<member><name>' . htmlspecialchars($name) . '</name>';
            $xml .= is_int($value) ? '<value><int>' . $value . '</int></value>' : '<value><string>' . htmlspecialchars($value) . '</string></value>';
            $xml .= '</member>';
        }
        $xml .= '</struct>
                    </value>
                </param>
            </params>
        </methodCall>';

        return $xml;
    }

    private function sendRequest($fp, string $xml): bool
    {
        $host = parse_url($this->simulatorURL, PHP_URL_HOST) ?? $this->simulatorURL;

        $headers = "POST / HTTP/1.1\r\n";
        $headers .= "Host: $host\r\n";
        $headers .= "Content-type: text/xml\r\n";
        $headers .= "Content-length: " . strlen($xml) . "\r\n";
        $headers .= "Connection: close\r\n\r\n";

        // Header und Body senden
        if (fwrite($fp, $headers) === false || fwrite($fp, $xml) === false) {
            return false;
        }

        return true;
    }

    private function getResponse($fp): string
    {
        $response = '';
        while (!feof($fp)) {
            $response .= fgets($fp, 128);
        }

        // Debugging: Rohantwort ausgeben oder loggen
        //file_put_contents('debug_response.log', $response);

        return $response;
    }

    private function parseResponse(string $response): array
    {
        // Extrahiere den Body aus der HTTP-Antwort
        $bodyPosition = strpos($response, "\r\n\r\n");
        if ($bodyPosition === false) {
            return ['error' => 'Invalid response format', 'response' => $response];
        }

        $body = substr($response, $bodyPosition + 4);

        // Versuche, die Antwort als XML zu parsen
        $xml = simplexml_load_string($body);
        if ($xml === false) {
            return ['error' => 'Invalid XML response', 'response' => $body];
        }

        // Überprüfe, ob die Antwort einen Fehler enthält
        if (isset($xml->fault)) {
            $faultString = (string)$xml->fault->value->struct->member->value->string;
            return ['error' => 'XML-RPC fault: ' . $faultString, 'response' => $body];
        }

        // Extrahiere Daten aus der XML-Antwort
        $result = [];
        foreach ($xml->xpath('//member') as $member) {
            $name = (string)$member->name;
            $value = (string)($member->value->string ?? $member->value->int ?? '');
            $result[$name] = $value;
        }

        return $result;
    }
}
?>