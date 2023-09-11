<?php

namespace Src\Utils;

class HttpSocket extends TcpSocket
{
    public function __construct(string $host, int $port = 80)
    {
        parent::__construct($host, $port);
        $this->connect();
    }

    public function doRequest(
        string $method,
        string $path,
        string|array $data = "",
        string $contentType = "application/x-www-form-urlencoded"
    ): string {
        $method = strtoupper($method);

        if(gettype($data) === "array") {
            $data = http_build_query($data);
        }

        $request = "{$method} {$path} HTTP/1.1\r\n";
        $request .= "HOST: {$this->host}:{$this->port}\r\n";
        if(!empty($data)) {
            $request .= "Content-type: {$contentType}\r\n";
            $request .= "Content-Length: " . strlen($data) . "\r\n";
        }
        $request .= "\r\n";

        if(!empty($data)) {
            $request .= $data;
            $request .= "\r\n";
        }

        $this->write($request);

        $response = "";
        while($chunk = $this->read()) {
            $response .= $chunk;
        }

        return preg_replace("/http(.*\n){6}/i", "", $response);
    }
}