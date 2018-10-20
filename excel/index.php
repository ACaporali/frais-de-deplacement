<?php
  use Src\App\Controllers\AppController;
  use Src\App\Controllers\FileController;

  echo "index 2";

  require_once('src/app/Controllers/AppController.php');
  require_once('src/app/Controllers/FileController.php');

  if (isset($_POST['submit'])) {//src/app/utils/upload.php
    echo "isset($_POST['submit']";
    $file = new FileController();
    $isUploaded = $file->upload($_FILES["fileToUpload"]);

    if ($isUploaded['succes']) {
      $isSave = $file->save($isUploaded['file']);

      $app = new AppController();
      $isEdited = $app->editeExcelFile($isUploaded['file']->getName());
    }
  } else {
    echo "Form-upload-file.php";
    require_once('src/app/Views/Form-upload-file.php');
  }

?>
