<?php
  use Src\App\Controllers\AppController;
  use Src\App\Controllers\FileController;

  echo "index 2!";

  require_once('src/app/Controllers/AppController.php');
  require_once('src/app/Controllers/FileController.php');

  if (isset($_POST['submit'])) {
    $file = new FileController();
    $isUploaded = $file->upload($_FILES["fileToUpload"]);
    var_dump($isUploaded);
    if ($isUploaded['succes']) {
      $isSave = $file->save($isUploaded['file']);
      echo "isSave : ";
      var_dump($isSave);
      $app = new AppController();
      $isEdited = $app->editeExcelFile($isUploaded['file']->getName());
      echo "isEdited : ";
      var_dump($isEdited);
    }
  } else {
    require_once('src/app/Views/Form-upload-file.php');
  }

?>
