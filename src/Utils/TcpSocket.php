<?php

namespace Src\Utils;

class TcpSocket
{
    protected \Socket $socket;
    protected string $host;
    protected string $port;

    public function __construct($host, $port)
    {
        $this->socket = @socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        $this->host = $host;
        $this->port = $port;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function isConnected(): bool
    {
        return socket_last_error($this->socket) === 0;
    }

    public function getError(): string
    {
        return strtolower(socket_strerror(socket_last_error($this->socket)));
    }

    public function connect(): void
    {
        socket_set_option($this->socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 8, 'usec' => 0));
        @socket_connect($this->socket, $this->host, $this->port);
    }

    public function write(string $data): void
    {
        socket_write($this->socket, $data, strlen($data));
    }

    public function read(): string
    {
        return socket_read($this->socket, 4096);
    }

    public function close(): void
    {
        socket_close($this->socket);
    }
}