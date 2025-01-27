<?php
/*
 * RemoteAdmin.php (2025) Created under PHP 8.3
 *
 * @author Manfred Zainhofer
 * @copyright Copyright (c) 2025, OpenSim Community.
 * @license MIT License
 * @version 1.0
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

    public function SendCommand(string $command, array $params = []): array
    {
        $xml = $this->buildXML($command, $params);

        $fp = @fsockopen($this->simulatorURL, $this->simulatorPort, $errno, $errstr, 5);

        if (!$fp) {
            return []; // Fehler angemessen behandeln
        }

        $this->sendRequest($fp, $xml);
        $response = $this->getResponse($fp);

        fclose($fp);

        return $this->parseResponse($response);
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

    private function sendRequest($fp, string $xml): void
    {
        fwrite($fp, "POST / HTTP/1.1\r\n");
        fwrite($fp, "Host: {$this->simulatorURL}\r\n");
        fwrite($fp, "Content-type: text/xml\r\n");
        fwrite($fp, "Content-length: " . strlen($xml) . "\r\n");
        fwrite($fp, "Connection: close\r\n\r\n");
        fwrite($fp, $xml);
    }

    private function getResponse($fp): string
    {
        $response = '';
        while (!feof($fp)) {
            $response .= fgets($fp, 128);
        }

        return substr($response, strpos($response, "\r\n\r\n"));
    }

    private function parseResponse(string $response): array
    {
        $result = [];
        if (preg_match_all('#<name>(.+)</name><value><(string|int)>(.*)</\2></value>#U', $response, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $result[$match[1]] = $match[3];
            }
        }
        return $result;
    }
}
?>
