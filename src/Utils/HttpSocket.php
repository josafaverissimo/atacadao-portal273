<?php

namespace Src\Utils;

class HttpSocket extends TcpSocket
{
    public function __construct(string $host, int $port = 80)
    {
        parent::__construct($host, $port);
        $this->connect();
    }

    public function doRequest(string $method, string $path, string|array $data = ""): string
    {
        $method = strtoupper($method);

        if(gettype($data) === "array") {
            $data = http_build_query($data);
        }

        $request = "{$method} {$path} HTTP/1.1\r\n";
        $request .= "HOST {$this->host}:{$this->port}\r\n";
        if(!empty($data)) {
            $request .= "Content-type: application/x-www-form-urlencoded\r\n";
            $request .= "Content-Length: " . strlen($data) . "\r\n";
        }
        $request .= "\r\n";
        $request .= $data;

        socket_write($this->socket, $request, strlen($request));

        $response = "";
        while($chunk = socket_read($this->socket, 4096)) {
            $response .= $chunk;
        }

        return $response;
    }
}