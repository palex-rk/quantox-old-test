<?php

namespace Src;

class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? "/";
    }
}