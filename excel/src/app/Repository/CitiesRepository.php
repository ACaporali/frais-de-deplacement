<?php

namespace Src\App\Repository;

/**
 * Do the requests to the data base
 */
class CitiesRepository
{

  /**
   * @param $connection, $cityStartAndCityEnd
   * Return the distances between each cities
   * @return array
   */
  function getDistance($connection, $cityStart, $cityEnd)
  {
    $return = null;

      $connection->query('SET CHARACTER SET utf8');


      $result = $connection->query('SELECT *
        FROM api_cities_distance d, api_city c1, api_city c2
        WHERE c1.id = d.id_cityStart
        AND c2.id = d.id_cityEnd
        AND c1.name = "' . $cityStart . '"
        AND c2.name = "' . $cityEnd . '" ');

      while ($data = $result->fetch_assoc()){
        $return = $data;
      }

    return $return;
  }
}

?>
