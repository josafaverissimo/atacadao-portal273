<?php

namespace Src\Interfaces\Core;

interface IMiddleware
{
    public function call(): void;
}