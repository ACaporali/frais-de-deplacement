<?php
namespace App\Controller;

require_once('app/Entity/City.php');
require_once('app/Table/CityTable.php');

use App\Entity\City;
use App\Table\CityTable;
/**
 * HomeController
 */
class CityController
{
  public function create($name = null)
  {
    $cityTable = new CityTable;

    //If name empty , show form create else save name in db
    if ($name != null) {
      $cityTable->createCity($name);

      // Redirection page accueil (home)
      header('Location: ./');
    }else {
      require_once('app/Views/city/create.php');
    }
  }
  public function update($id, $name = null)
  {
    $cityTable = new CityTable;

    //If name empty , show form update else save newName in db
    if ($name != null) {
      $cityTable->updateCity($id, $name);

      // Redirection page accueil (home)
      header('Location: ./');
    }else {
      $res = $cityTable->getCity($id);

      while ($data = $res->fetch()){
        $city = new City();
        $city->setId($data['id']);
        $city->setName($data['name']);
      }

      require_once('app/Views/city/update.php');
    }
  }

  public function delete($id)
  {
    $cityTable = new CityTable;
    $cities = $cityTable->deleteCity($id);

    // Redirection page accueil (home)
    header('Location: ./');
  }

  public function retrieveCities()
  {
    $cityTable = new CityTable;
    $resCities = $cityTable->getCities();
    $resultCities = [];

    while ($data = $resCities->fetch()){
      $city = new City();
      $city->setName($data['name']);
      $resultCities[$data['id']] = $city;
    }

    return $resultCities;
  }
}


?>
