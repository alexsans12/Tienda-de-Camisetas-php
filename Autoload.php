<?php
function controllers_autoloader($class)
{
    include_once 'Controllers/'. $class . '.php';
}

spl_autoload_register('controllers_autoloader');
