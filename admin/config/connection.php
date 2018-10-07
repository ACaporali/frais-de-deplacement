<?php
try {
  $bdd = new PDO('mysql:host='.getenv('db_host').'; dbname='.getenv('db_name').'', getenv('db_user'), getenv('db_pwd'));
}
catch(exception $e) {
  die('Erreur '.$e->getMessage().' | '.getenv('db_host'));
}
?>
