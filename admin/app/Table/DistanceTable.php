<?php
namespace App\Table;

require_once(__DIR__.'/../../config/connection.php');
/**
 * DistanceTable
 * Entity : Distance
 */
class DistanceTable
{
  public function getDistances()
  {
    global $bdd;

    $bdd->query('SET CHARACTER SET utf8');
    $result = $bdd->query('SELECT d.id, c1.id as idCityStart, c1.name as nameCityStart, c2.id as idCityEnd, c2.name as nameCityEnd, d.km
      FROM api_cities_distance d, api_city c1, api_city c2
      WHERE c1.id = d.id_cityStart
      AND c2.id = d.id_cityEnd');
    //SELECT * FROM api_cities_distance ORDER BY api_cities_distance.id_cityStart ASC

    return $result;
  }

  public function getDistance($id)
  {
    global $bdd;

    $bdd->query('SET CHARACTER SET utf8');
    $result = $bdd->query('SELECT d.id, c1.id as idCityStart, c1.name as nameCityStart, c2.id as idCityEnd, c2.name as nameCityEnd, d.km
      FROM api_cities_distance d, api_city c1, api_city c2
      WHERE c1.id = d.id_cityStart
      AND c2.id = d.id_cityEnd
      AND d.id = ' . $id);

    return $result;
  }

  public function createDistance($cityStart, $cityEnd, $km)
  {
    global $bdd;

    $bdd->query('SET CHARACTER SET utf8');
    $result = $bdd->query('INSERT INTO api_cities_distance (id_cityStart, id_cityEnd, km) VALUES
    ("' . $cityStart . '", "' . $cityEnd . '", "' . $km . '")');

    return $result;
  }

  public function updateDistance($id, $cityStart, $cityEnd, $km)
  {
    global $bdd;

    $bdd->query('SET CHARACTER SET utf8');
    $result = $bdd->query('UPDATE api_cities_distance SET id_cityStart = "' . $cityStart . '",
    id_cityEnd = "' . $cityEnd . '", km = "' . $km . '" WHERE api_cities_distance.id = ' . $id);

    return $result;
  }

  public function deleteDistance($id)
  {
    global $bdd;

    $bdd->query('SET CHARACTER SET utf8');
    $result = $bdd->query('DELETE FROM api_cities_distance WHERE api_cities_distance.id = ' . $id);

    return $result;
  }
}


?>
