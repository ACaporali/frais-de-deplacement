<?php
namespace App\Table;

require_once(__DIR__.'/../../config/connection.php');
/**
 * CityTable
 * Entity : City
 */
class CityTable
{
  public function getCities()
  {
    global $bdd;

    $bdd->query('SET CHARACTER SET utf8');
    $result = $bdd->query('SELECT * FROM api_city ORDER BY api_city.name ASC');

    return $result;
  }

  public function getCity($id)
  {
    global $bdd;

    $bdd->query('SET CHARACTER SET utf8');
    $result = $bdd->query('SELECT * FROM api_city WHERE api_city.id = ' . $id);

    return $result;
  }

  public function createCity($name)
  {
    global $bdd;

    $bdd->query('SET CHARACTER SET utf8');
    $result = $bdd->query('INSERT INTO api_city (name) VALUES ("' . $name . '")');

    return $result;
  }

  public function updateCity($id, $name)
  {
    global $bdd;

    $bdd->query('SET CHARACTER SET utf8');
    $result = $bdd->query('UPDATE api_city SET name = "' . $name . '" WHERE api_city.id = ' . $id);

    return $result;
  }

  public function deleteCity($id)
  {
    global $bdd;

    $bdd->query('SET CHARACTER SET utf8');
    $result = $bdd->query('DELETE FROM api_city WHERE api_city.id = ' . $id);

    return $result;
  }
}


?>
