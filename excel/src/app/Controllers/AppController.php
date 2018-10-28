<?php

namespace Src\App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use \PDO;
use Src\Config\ConnectionDataBase;
use Src\App\Repository\CitiesRepository;

require 'vendor/autoload.php';
require_once('src/config/connectionDataBase.php');
require_once('src/app/Repository/CitiesRepository.php');

/**
 * Read and write the km in the given excel file
 */
class AppController
{
  /**
  * Read and write the km in the given excel file
  */
  public function editeExcelFile(String $file)
  {
    $return = false;
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    $targetDir = __DIR__.'/';

    $spreadsheet = $reader->load($targetDir.$file);
    $worksheet = $spreadsheet->getActiveSheet();
    $highestRow = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

    // Search in file the row and cell with the text 'de depart' and 'de retour'
    $cellsIndex = $this->getIndexCells($highestRow, $highestColumnIndex, $worksheet);

    // Get all cities starts names and all cities end names
    $cityStartAndCityEnd = $this->getCitiesName(
      $cellsIndex['cityStart'],
      $cellsIndex['cityEnd'],
      $cellsIndex['isCellReferenceCityStart'],
      $cellsIndex['isCellReferenceCityEnd'],
      $worksheet
    );

    // Search in the bdd the distance by the cityStart and the cityEnd
    if (!empty($cityStartAndCityEnd)) {
      $distances = $this->getDistances($cityStartAndCityEnd);

      if (!empty($distances)) {
        foreach ($cityStartAndCityEnd as $key => $value) {
          if (!empty($distances[$key])) {
            $worksheet->getCellByColumnAndRow($cellsIndex['km']['col'], $key)->setValue($distances[$key]['km']);
          } else {
            $worksheet->getCellByColumnAndRow($cellsIndex['km']['col'], $key)->setValue('notFound!');
            $spreadsheet->getActiveSheet()->getStyleByColumnAndRow($cellsIndex['km']['col'], $key)
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyleByColumnAndRow($cellsIndex['km']['col'], $key)
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
          }
        }
      }
    }

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');

    if (!empty($writer)) {
      $writer->save($targetDir.'v2'.$file);
      require_once('src/app/Views/Download-file.php');
      $return = true;
    }

    return $return;
  }

  /**
  * Get all the index for start to read the cities and to write the km in the good cells
  * @return Array
  */
  public function getIndexCells(int $highestRow, int $highestColumnIndex, $worksheet)
  {
    $return = [];
    $cellReferenceCityStart = [];
    $cellReferenceCityEnd = [];
    $cellReferenceKm = [];

    $isCellReferenceCityStart = false;
    $isCellReferenceCityEnd = false;
    $isCellReferenceKm = false;

    for ($row = 1; $row <= $highestRow; ++$row) {
      // Stop the search if values are found
      if ($isCellReferenceCityStart == false
      && $isCellReferenceCityEnd == false
      && $isCellReferenceKm == false) {
        for ($col = 1; $col <= $highestColumnIndex; ++$col) {
          $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
          if ($value == 'de depart') {
            $cellReferenceCityStart['col'] = $col;
            $cellReferenceCityStart['row'] = $row;
            $isCellReferenceCityStart = true;
          }
          if ($isCellReferenceCityStart == true && $value == 'de retour') {
            $cellReferenceCityEnd['col'] = $col;
            $cellReferenceCityEnd['row'] = $row;
            $isCellReferenceCityEnd = true;
          }
          if ($isCellReferenceCityEnd == true && $value == 'parcourus') {
            $cellReferenceKm['col'] = $col;
            $cellReferenceKm['row'] = $row;
            $isCellReferenceKm == true;
            break;
          }
        }
      } else {
        break;
      }
    }

    $return = [
      'cityStart' => $cellReferenceCityStart,
      'cityEnd' => $cellReferenceCityEnd,
      'km' => $cellReferenceKm,
      'isCellReferenceCityStart' => $isCellReferenceCityStart,
      'isCellReferenceCityEnd' => $isCellReferenceCityEnd
    ];

    return $return;
  }

  /**
  * Get the an array with all cities strt and all cities end
  * @return Array
  */
  public function getCitiesName (
    $cellReferenceCityStart,
    $cellReferenceCityEnd,
    $isCellReferenceCityStart,
    $isCellReferenceCityEnd,
    $worksheet
    )
  {
    $cityStartAndCityEnd = [];

    if ($isCellReferenceCityStart == true && $isCellReferenceCityEnd == true) {
      for ($i= 1; !empty($worksheet->getCellByColumnAndRow($cellReferenceCityStart['col'], $cellReferenceCityStart['row']+$i)->getValue()); $i++) {
        $cityStartAndCityEnd[$cellReferenceCityStart['row']+$i]['start'] = $worksheet->getCellByColumnAndRow($cellReferenceCityStart['col'], $cellReferenceCityStart['row']+$i)->getValue();
      }
      for ($i= 1; !empty($worksheet->getCellByColumnAndRow($cellReferenceCityEnd['col'], $cellReferenceCityEnd['row']+$i)->getValue()); $i++) {
        $cityStartAndCityEnd[$cellReferenceCityEnd['row']+$i]['end'] = $worksheet->getCellByColumnAndRow($cellReferenceCityEnd['col'], $cellReferenceCityEnd['row']+$i)->getValue();
      }
    }

    return $cityStartAndCityEnd;
  }

  /**
  * Get all distances between cities start and citues end.
  * If no results found, get distances between cities end and cities start
  * @return Array
  */
  public function getDistances($cityStartAndCityEnd)
  {
    $return = [];
    $connectionDataBase = new ConnectionDataBase();
    $connection = $connectionDataBase->getConnection();

    $citiesRepository = new CitiesRepository();

    foreach ($cityStartAndCityEnd as $key => $cities) {
      if (!isset($cities['start']) || !isset($cities['end'])) {
        $cities['start'] = null;
        $cities['end'] = null;
      }

      $resultat = $citiesRepository->getDistance($connection, $cities['start'], $cities['end']);

      if (!empty($resultat)) {
        $return[$key] = $resultat;
      } else { // ex: if distance voiron-grenoble not found, search grenoble-voiron
        $resultat = $citiesRepository->getDistance($connection, $cities['end'], $cities['start']);
        $return[$key] = $resultat;
      }

    }

    return $return;
  }
}

?>
