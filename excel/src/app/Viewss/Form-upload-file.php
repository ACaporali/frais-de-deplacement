<!DOCTYPE html>
<html>
  <body>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
      <label for="">Select un ficher Excel (2007) à uploder :</label>
      <input type="file" name="fileToUpload" id="fileToUpload">
      <input type="submit" value="Upload Image" name="submit">
    </form>

  </body>
</html>
