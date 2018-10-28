<?php

namespace Src\App\Controllers;

use Src\App\Utils\UploadExcelFile;
use Src\App\Entity\File;
use Src\App\Repository\FileRepository;
use Src\Config\ConnectionDataBase;

require_once('src/app/Utils/UploadExcelFile.php');
require_once('src/app/Repository/FileRepository.php');
require_once('src/config/connectionDataBase.php');

/**
 * Manage Excel file
 */
class FileController
{
  /**
  * Save the name and date create in data base
  */
  public function save(File $file)
  {
    $connectionDataBase = new ConnectionDataBase();
    $connection = $connectionDataBase->getConnection();
    var_dump($connection);

    $fileRepsitory = new FileRepository();
    $isSucces = $fileRepsitory->createFile($connection, $file->getName(), $file->getUploadDate());
  }

  /**
  * Call UploadExcelFile for upload the Excel file
  */
  public function upload(array $file)
  {
    $upload = new UploadExcelFile($file);
    return $upload->uploadFile();
  }

}

?>
