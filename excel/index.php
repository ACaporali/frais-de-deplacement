<?php
  use Src\Controllers\AppController;
  use Src\Controllers\UploadController;

  echo "index 2";
  echo getenv('test');
  echo $_SERVER['PHP_SELF'];

  require_once('src/app/controllers/appController.php');
  require_once('src/app/controllers/uploadController.php');

  if (isset($_POST['submit'])) {//src/app/utils/upload.php
    $upload = new UploadController($_FILES["fileToUpload"]);
    $isUploaded = $upload->uploadFile();

    if ($isUploaded) {
      $app = new AppController();
      $isEdited = $app->editeExcelFile();
    }
  } else {
    require_once('src/app/views/form-upload-file.php');
  }

?>
