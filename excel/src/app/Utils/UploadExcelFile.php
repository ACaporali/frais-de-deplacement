<?php

namespace Src\App\Utils;

use Src\App\Entity\File;

require_once('src/app/Entity/File.php');

/**
 * Upload the Excel file in the 'uploads' directory
 */
class UploadExcelFile
{
  private $file;
  private $fileType;
  private $targetDir;
  private $targetFile;

  function __construct(array $file)
  {
    $this->file = $file;
    $this->targetDir = __DIR__.'../../../../uploads/';//new : ../../../uploads/ avant le dossier controllers : ../../uploads/
    $this->targetFile = $this->targetDir . basename($this->file["name"]);
    $this->fileType = strtolower(pathinfo($this->targetFile,PATHINFO_EXTENSION));
  }

  public function uploadFile()
  {
    $timestamp = time();
    $return['succes'] = false;
    $isExcelType = $this->checkType($this->file["tmp_name"]);
    $isExistFile = false;
    $isSizeFileOk = false;

    if ($isExcelType) {
      $isExistFile = $this->existFile($this->targetDir . basename($timestamp.$this->file["name"]));
    } else {
      echo "File is not an Excel file (xls extention/type).";
    }

    if ($isExistFile) {
      $isSizeFileOk = $this->sizeFile($this->file["size"], 500000000000000000000000000);
    } else {
      echo "Sorry, file already exists.";
    }

    if ($isSizeFileOk) {
      echo 'file name tmp :' .$this->file["tmp_name"]. ' to : '.$this->targetFile;
      if (move_uploaded_file($this->file["tmp_name"], $this->targetFile )) {
        echo 'is the file moved ? ';
        $moved = move_uploaded_file($this->file["tmp_name"], $this->targetFile );
        if($moved)
        {
            echo "sucess";
        }
        else
        {
            echo 'failed';
        }
        $newName = $timestamp.$this->file["name"];
        rename($this->targetDir.$this->file["name"], $this->targetDir.$newName.$this->file["name"]);
        echo "The file ". basename($this->file["name"]). " has been uploaded.";
        $fileEntity = new File($newName);
        $return['succes'] = true;
        $return['file'] = $fileEntity;
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
    } else {
      echo "Sorry, your file is too large.";
    }

    return $return;
  }

  private function checkType ($file)
  {
    $return = false;

    if('application/vnd.ms-excel' === mime_content_type($file)) {
      echo "File is an Excel file - ";
      $return = true;
    } else {
      echo "File is not an Excel file (xls extention/type).";
    }

    if($this->fileType != "xls") {
      echo "Sorry, only xls files are allowed.";
      $return = true;
    }

    return $return;
  }

  private function existFile($file)
  {
    $return = true;

    if (file_exists($file)) {
      echo "Sorry, file already exists.";
      $return = false;
    }

    return $return;
  }

  private function sizeFile($file, float  $size)
  {
    $return = true;

    if ($file > $size) {
      echo "Sorry, your file is too large.";
      $return = false;
    }

    return $return;
  }
}

 ?>
