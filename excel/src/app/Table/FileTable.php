<?php
namespace App\Table;

require_once(__DIR__.'/../../config/connection.php');
/**
 * FileTable
 * Entity : File
 */
class FileTable
{
  public function getFiles()
  {
    global $bdd;

    $bdd->query('SET CHARACTER SET utf8');
    $result = $bdd->query('SELECT * FROM api_file ORDER BY api_file.name ASC');

    return $result;
  }

  public function getFile($id)
  {
    global $bdd;

    $bdd->query('SET CHARACTER SET utf8');
    $result = $bdd->query('SELECT * FROM api_file WHERE api_file.id = ' . $id);

    return $result;
  }

  public function createFile($name)
  {
    global $bdd;

    $bdd->query('SET CHARACTER SET utf8');
    $result = $bdd->query('INSERT INTO api_file (name) VALUES ("' . $name . '")');

    return $result;
  }

  public function updateFile($id, $name)
  {
    global $bdd;

    $bdd->query('SET CHARACTER SET utf8');
    $result = $bdd->query('UPDATE api_file SET name = "' . $name . '" WHERE api_file.id = ' . $id);

    return $result;
  }

  public function deleteFile($id)
  {
    global $bdd;

    $bdd->query('SET CHARACTER SET utf8');
    $result = $bdd->query('DELETE FROM api_file WHERE api_file.id = ' . $id);

    return $result;
  }
}


?>
