<?php

namespace Src\Config;

use \PDO;

/**
 * Manage the connection with the data base
 */
class ConnectionDataBase
{
  /**
  * Create the connection
  */
  public function getConnection()
  {
    try {
      return new PDO('mysql:host=localhost; dbname=api', 'root', '');
    } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage() . "<br/>";
      die();
    }
  }

}

?>
