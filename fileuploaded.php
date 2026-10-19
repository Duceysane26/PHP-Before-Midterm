<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>upload files</title>
</head>

<body>
  <form action="" method="post" enctype="multipart/form-data">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name"><br><br>

    <label for="file">Choose a file:</label>
    <input type="file" id="file" name="file"><br><br>
    <input type="submit" value="Upload">



  </form>

</body>

</html>
<?php
if (isset($_POST["submit"])) {

  echo "<h3>File Information:</h3>";




}