<?php
namespace Zeblogphp;

use PDO;

class DBConnect extends PDO
{
  public function __construct($file = __DIR__.'/settings.ini')
  {
    if (!$settings = parse_ini_file($file, TRUE)) throw new exception('Unable to open ' . $file . '.');
    $dns = $settings['database']['driver'] .
    ':host=' . $settings['database']['host'] .
    ';dbname=' . $settings['database']['schema'];  
    parent::__construct($dns, $settings['database']['username'], $settings['database']['password']); 
  }
}