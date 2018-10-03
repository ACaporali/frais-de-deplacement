<?php
namespace App\Controller;

require_once('app/Entity/City.php');
require_once('app/Entity/Distance.php');
require_once('app/Table/CityTable.php');
require_once('app/Table/DistanceTable.php');
require_once('app/Controller/CityController.php');
require_once('app/Controller/DistanceController.php');

use App\Entity\City;
use App\Entity\Distance;
use App\Table\CityTable;
use App\Table\DistanceTable;
use App\Controller\CityController;
use App\Controller\DistanceController;
/**
 * HomeController
 */
class HomeController
{
  public function index()
  {
    $cityController = new CityController;
    $resultCities = $cityController->retrieveCities();

    $distanceController = new DistanceController;
    $resultDistances = $distanceController->retrieveDistances();

    require_once(__DIR__.'/../Views/home.php');
  }
}


?>
