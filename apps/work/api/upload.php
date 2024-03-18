<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Upload File To Database</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="0-dummy.css">
  </head>
  <body>
  

    <!-- (B) HTML FILE UPLOAD FORM -->
    <form method="post" action="/api/storageAPI.php" enctype="multipart/form-data">
      <label for="upload">Upload File</label>
      <input type="file" name="upload" required>
      <input type="text" name="title" placeholder="Title">
      <input type="hidden" name="uid" value="<?php echo $_SESSION['user_id']; ?>">
      <input type="submit" name="submit" value="Upload File">
    </form>
  </body>
</html>