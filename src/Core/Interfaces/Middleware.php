<?php

namespace Src\Core\Interfaces;

interface Middleware
{
    public function call(): void;
}