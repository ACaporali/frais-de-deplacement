<?php
namespace Src\App\Repository;

/**
 * FileRepository
 * Entity : File
 */
class FileRepository
{
  public function createFile($connection, $name, $date)
  {
    $connection->query('SET CHARACTER SET utf8');
    $result = $connection->query('INSERT INTO api_file (name, uploadDate) VALUES ("' . $name . ', ' . $date . '")');

    return $result;
  }
}


?>
