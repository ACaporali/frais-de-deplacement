<?php
namespace App\Controller;

require_once('app/Entity/Distance.php');
require_once('app/Table/DistanceTable.php');
require_once('app/Controller/CityController.php');

use App\Table\DistanceTable;
use App\Table\CityTable;
use App\Entity\Distance;
use App\Entity\City;
use App\Controller\CityController;
/**
 * DistanceController
 */
class DistanceController
{
  public function create($cityStart = null, $cityEnd = null, $km = null)
  {
    //If name empty , show form create else save name in db
    if ($cityStart != null && $cityEnd != null && $km != null) {
      $distanceTable = new DistanceTable;
      $isSucces = $distanceTable->createDistance($cityStart, $cityEnd, $km);

      if (!$isSucces) {
        throw new \Exception('Une erreur s\'est produite avec la base de données', 1);
      } else {
        // Redirection page accueil (home)
        header('Location: ./');
      }
    }else {
      $cityController = new CityController;
      $resCities = $cityController->retrieveCities();

      require_once('app/Views/distance/create.php');
    }
  }
  public function update($id, $cityStart = null, $cityEnd = null, $km = null)
  {
    $distanceTable = new DistanceTable;

    //If name empty , show form update else save newName in db
    if ($id != null && $cityStart != null && $cityEnd != null && $km != null) {
      $isSucces = $distanceTable->updateDistance($id, $cityStart, $cityEnd, $km);

      if (!$isSucces) {
        throw new \Exception('Une erreur s\'est produite avec la base de données', 1);
      } else {
        // Redirection page accueil (home)
        header('Location: ./');
      }
    }else {
      $res = $distanceTable->getDistance($id);

      if ($res) {
        while ($data = $res->fetch()){
          $cityStart = new City();
          $cityStart->setId($data['idCityStart']);
          $cityStart->setName($data['nameCityStart']);

          $cityEnd = new City();
          $cityEnd->setId($data['idCityEnd']);
          $cityEnd->setName($data['nameCityEnd']);

          $distance = new Distance();
          $distance->setCityStart($cityStart);
          $distance->setCityEnd($cityEnd);
          $distance->setKm($data['km']);
          $distance->setId($data['id']);
        }
      } else {
        throw new \Exception('Une erreur s\'est produite avec la base de données', 1);
      }

      $cityController = new CityController;
      $resCities = $cityController->retrieveCities();

      require_once('app/Views/distance/update.php');
    }
  }

  public function delete($id)
  {
    $distanceTable = new DistanceTable;
    $isSucces = $distanceTable->deleteDistance($id);

    if (!$isSucces) {
      throw new \Exception('Une erreur s\'est produite avec la base de données', 1);
    } else {
      // Redirection page accueil (home)
      header('Location: ./');
    }
  }

  public function retrieveDistances()
  {
    $distanceTable = new DistanceTable;
    $resDistances = $distanceTable->getDistances();
    $resultDistances = [];

    if ($resDistances) {
      while ($data = $resDistances->fetch()){
        $cityStart = new City();
        $cityStart->setId($data['idCityStart']);
        $cityStart->setName($data['nameCityStart']);

        $cityEnd = new City();
        $cityEnd->setId($data['idCityEnd']);
        $cityEnd->setName($data['nameCityEnd']);

        $distance = new Distance();
        $distance->setCityStart($cityStart);
        $distance->setCityEnd($cityEnd);
        $distance->setKm($data['km']);
        $resultDistances[$data['id']] = $distance;
      }
    } else {
      throw new \Exception('Une erreur s\'est produite avec la base de données', 1);
    }

    return $resultDistances;
  }
}


?>
