<?php

/* Autoloader for namespaces
 *
 * @author      Tobias Mathes <tobias.mathes@gmail.com>
 * @todo        Update to newer (already existing) version after structure changes
 */
function __autoload($class)
{
    // breakdown $class, so we can 'load' the proper file
    $parts = explode('\\', $class);

    if (sizeof($parts) > 2)
    {
        $_path_prefix = './';

        // @todo Remove exception for Nanoserv handlers    
        if ($parts[0] === 'Nanoserv')
        {
          unset($parts[0]);
          $_path_prefix = './handlers/';
        }

        // build file path
        $_path = $_path_prefix . implode('/', $parts) . '.php';
    }
    else
    {
        $_path = './nanoserv.php';
    }

    // only try include if file is readable
    if (is_readable($_path))
    {
      require_once($_path);
    }
}
