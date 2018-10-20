<?php

namespace Src\Config;

use \Mysqli;

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
      $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
      $server = $url["host"];
      $username = $url["user"];
      $password = $url["pass"];
      $db = substr($url["path"], 1);

      return new mysqli($server, $username, $password, $db);
    } catch (exception $e) {
      print "Erreur !: " . $e->getMessage() . "<br/>";
      die();
    }
  }

}

?>
