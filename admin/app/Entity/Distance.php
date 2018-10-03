<?php
namespace App\Entity;

require_once('app/Entity/City.php');

use App\Entity\City;

/**
 * Distance
 * Table : DistanceTable
 */
class Distance
{
  protected $id;
  protected $cityStart;
  protected $cityEnd;
  protected $km;

  function __construct()
  {
    // code...
  }

  public function getId()
  {
    return $this->id;
  }

  public function setId(int $id)
  {
    $this->id = $id;

    return $this->id;
  }

  public function getCityStart()
  {
    return $this->idCityStart;
  }

  public function setCityStart(City $idCityStart)
  {
    $this->idCityStart = $idCityStart;

    return $this->idCityStart;
  }

  public function getCityEnd()
  {
    return $this->idCityEnd;
  }

  public function setCityEnd(City $idCityEnd)
  {
    $this->idCityEnd = $idCityEnd;

    return $this->idCityEnd;
  }

  public function getKm()
  {
    return $this->km;
  }

  public function setKm(int $km)
  {
    $this->km = $km;

    return $this->km;
  }
}

?>
