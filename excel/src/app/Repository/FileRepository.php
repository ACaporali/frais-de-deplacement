<?php
namespace App\Table;

/**
 * FileRepository
 * Entity : File
 */
class FileRepository
{
  public function getFile($connection, $id)
  {
    $connection->exec('SET CHARACTER SET utf8');
    $result = $connection->query('SELECT * FROM api_file WHERE api_file.id = ' . $id);

    return $result;
  }

  public function createFile($connection, $name)
  {
    $connection->exec('SET CHARACTER SET utf8');
    $result = $connection->query('INSERT INTO api_file (name) VALUES ("' . $name . '")');

    return $result;
  }

  public function updateFile($connection, $id, $name)
  {
    $connection->exec('SET CHARACTER SET utf8');
    $result = $connection->query('UPDATE api_file SET name = "' . $name . '" WHERE api_file.id = ' . $id);

    return $result;
  }

  public function deleteFile($connection, $id)
  {
    $connection->exec('SET CHARACTER SET utf8');
    $result = $connection->query('DELETE FROM api_file WHERE api_file.id = ' . $id);

    return $result;
  }
}


?>
