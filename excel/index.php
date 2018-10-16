<?php
  use Src\App\Controllers\AppController;
  use Src\App\Controllers\UploadController;

  echo "index 2";
  echo getenv('test');
  echo $_SERVER['PHP_SELF'];

  require_once('src/app/Controllers/AppController.php');
  require_once('src/app/Controllers/UploadController.php');

  if (isset($_POST['submit'])) {//src/app/utils/upload.php
    $upload = new UploadController($_FILES["fileToUpload"]);
    $isUploaded = $upload->uploadFile();

    if ($isUploaded) {
      $app = new AppController();
      $isEdited = $app->editeExcelFile();
    }
  } else {
    require_once('src/app/Views/Form-upload-file.php');
  }

?>
