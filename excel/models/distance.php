<?php
require("connectionDb.php");

$name = "";

function getDistances($start, $end)
{
  global $db;

  $response = $db->query(
    'SELECT cityS.name as cityStart, cityE.name as cityEnd, CD.id, CD.distance
    FROM cities_distance CD
    INNER JOIN city cityS ON CD.id_cityStart = cityS.id
    INNER JOIN city cityE ON CD.id_cityEnd = cityE.id
    WHERE cityS.name = "'.$start.'"
    AND cityE.name = "'.$end.'"');
    return $response;
  }
  ?>
