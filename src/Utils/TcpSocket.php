<?php

namespace Src\Utils;

class TcpSocket
{
    protected \Socket $socket;
    protected string $host;
    protected string $port;

    public function __construct($host, $port)
    {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        $this->host = $host;
        $this->port = $port;
    }

    protected function getHost(): string
    {
        return $this->host;
    }

    protected function getPort(): int
    {
        return $this->port;
    }

    public function getError(): string
    {
        return strtolower(socket_strerror(socket_last_error($this->socket)));
    }

    public function connect(): void
    {
        socket_set_option($this->socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 8, 'usec' => 0));
        socket_connect($this->socket, $this->host, $this->port);
    }

    public function close(): void
    {
        socket_close($this->socket);
    }
}