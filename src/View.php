<?php

namespace Src;

class View
{
    public static function render($view, $data = [])
    {
        extract($data);

        $file = DOCUMENT_ROOT . "/app/view/$view";
    
        if (is_readable($file)) {
            require ($file);
        } else {
            echo " $file not exists";
        }
    }
}