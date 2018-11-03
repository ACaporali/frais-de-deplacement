<!DOCTYPE html>
<html>
  <body>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
      <label for="">Selectionez un ficher Excel à uploder :</label>
      <input type="file" name="fileToUpload" id="fileToUpload">
      <input type="submit" value="Upload Image" name="submit">
    </form>

  </body>
</html>
