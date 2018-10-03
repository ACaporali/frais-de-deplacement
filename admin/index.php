<?php
use App\Controller\HomeController;

require_once('header.html');
require_once('app/Controller/HomeController.php');
require_once('app/Controller/CityController.php');
require_once('app/Controller/DistanceController.php');

if (isset($_GET['action'])) {
  $action= $_GET['action'];
}
else {
  $action= 'home';
}

switch($action) {
  case 'home':
    $home = new App\Controller\HomeController();
    $home->index();
    break;
  case 'createCity':
    $city = new App\Controller\CityController();
    if ( isset($_POST['name'])) {
      $city->create(($_POST['name']));
    } else {
      $city->create();
    }
    break;
  case 'updateCity':
    $city = new App\Controller\CityController();
    if ( isset($_POST['newName'])) {
      $city->update( $_GET['id'],  $_POST['newName']);
    } else {
      $city->update($_GET['id']);
    }
    break;
  case 'deleteCity':
    $home = new App\Controller\CityController();
    $home->delete($_GET['id']);
    break;
  case 'createDistance':
    $distance = new App\Controller\DistanceController();
    if ( isset($_POST['start']) && isset($_POST['end']) && isset($_POST['km']) ) {
      $distance->create(($_POST['start']), ($_POST['end']), ($_POST['km']));
    } else {
      $distance->create();
    }
    break;
  case 'updateDistance':
    $distance = new App\Controller\DistanceController();
    if ( isset($_POST['start']) && isset($_POST['end']) && isset($_POST['km']) ) {
      $distance->update( $_GET['id'], ($_POST['start']), ($_POST['end']), ($_POST['km']));
    } else {
      $distance->update($_GET['id']);
    }
    break;
  case 'deleteDistance':
    $home = new App\Controller\DistanceController();
    $home->delete($_GET['id']);
    break;
  default:
    $home = new App\Controller\HomeController();
    $home->index();
    break;
}
?>
