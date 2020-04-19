
<?php
session_start();

$msg = '';
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {	
   if ($_POST['username'] == 'Ieva' && $_POST['password'] == '01234') {
      $_SESSION['logged_in'] = true;
      $_SESSION['username'] = 'Ieva';
   } else {
      $msg = 'Wrong username or password';
   }
}

if(isset($_GET['action']) and $_GET['action'] == 'logout'){
   session_start();
   unset($_SESSION['username']);
   unset($_SESSION['password']);
   unset($_SESSION['logged_in']); 
}

if (isset($_FILES['image'])) {
   $errors = array();
   $file_name = $_FILES['image']['name'];
   $file_size = $_FILES['image']['size'];
   $file_tmp = $_FILES['image']['tmp_name'];
   $file_type = $_FILES['image']['type'];
   $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
   $extensions = array("jpeg", "jpg", "png");
   if (in_array($file_ext, $extensions) === false) {
      $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
   }
   if ($file_size > 2097152) {
      $errors[] = 'File size must be excately 2 MB';
   }
   if (empty($errors) == true) {
      move_uploaded_file($file_tmp, "./" . $file_name);
      echo "Success";
   } else {
      print_r($errors);
   }
}

if(!$_SESSION['logged_in'] == true){
   print('<form action = "" method = "post">');
   print('<h4>' . $msg . '</h4>');
   print('<h2>Enter Username and Password</h2>');
   print('<input type = "text" name = "username" placeholder = "username = Ieva" required autofocus></br>');
   print('<input type = "password" name = "password" placeholder = "password = 01234" required>');
   print('</br><button class = "btn btn-lg btn-primary btn-block" type = "submit" name = "login">Login</button>');
   print('</form>');
   die();
   }
   
   $path = './' . $_GET["path"];
   $files_and_dirs = scandir($path);
   
 print('<h2>Directory contents: ' . str_replace('?path=/','',$_SERVER['REQUEST_URI']) . '</h2>');


if (isset($_POST['download'])) {
   print('Path to download: ' . './' . $_GET["path"] . $_POST['download']);
   $file = './' . $_GET["path"] . $_POST['download'];
   $fileToDownloadEscaped = str_replace("&nbsp;", " ", htmlentities($file, null, 'utf-8'));

   header('Content-Description: File Transfer');
   header('Content-Type: application/pdf');
   header('Content-Disposition: attachment; filename=' . basename($fileToDownloadEscaped));
   header('Content-Transfer-Encoding: binary');
   header('Expires: 0');
   header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
   header('Pragma: public');
   header('Content-Length: ' . filesize($fileToDownloadEscaped));
   readfile($fileToDownloadEscaped);
   exit;
}


if (isset($_POST['delete'])) {
   $objToDelete = './' . $_GET["path"] . $_POST['delete'];
   $objToDeleteEscaped = str_replace("&nbsp;", " ", htmlentities($objToDelete, null, 'utf-8'));
   if (is_file($objToDeleteEscaped)) {
      if (file_exists($objToDeleteEscaped)) {
         unlink($objToDeleteEscaped);
      }
   }
}


print('<table><th>Type</th><th>Name</th><th>Actions</th>');
foreach ($files_and_dirs as $fnd) {
   if ($fnd != ".." and $fnd != ".") {
      print('<tr>');
      print('<td>' . (is_dir($path . $fnd) ? "Directory" : "File") . '</td>');
      print('<td>' . (is_dir($path . $fnd)
         ? '<a href="' . (isset($_GET['path'])
            ? $_SERVER['REQUEST_URI'] . $fnd . '/'
            : $_SERVER['REQUEST_URI'] . '?path=' . $fnd . '/') . '">' . $fnd . '</a>'
         : $fnd)
         . '</td>');
      print('<td>'
         . (is_dir($path . $fnd)
            ? ''
            : '<form style="display: inline-block" action="" method="post">
            <input type="hidden" name="delete" value=' . str_replace(' ', '&nbsp;', $fnd) . '>
            <input type="submit" value="Delete">
            </form>
            <form style="display: inline-block" action="" method="post">
            <input type="hidden" name="download" value=' . str_replace(' ', '&nbsp;', $fnd) . '>
            <input type="submit" value="Download">
            </form>')
         . "</form></td>");
      print('</tr>');
   }
}
print("</table>");

?>

<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
   <title>Failu narsykle</title>
</head>

<body>
   <form action="" method="POST" enctype="multipart/form-data">
      <input style="margin-top:20px;" type="file" name="image" />
      <input style="display: block; margin-top:20px; width: 10%" type="submit" />
   </form>
   <ul>
      <li>Sent file: <?php echo $_FILES['image']['name'];  ?>
      <li>File size: <?php echo $_FILES['image']['size'];  ?>
      <li>File type: <?php echo $_FILES['image']['type'] ?>
   </ul>
   
</body>
Click here to <a href="index.php?action=logout"> logout.
</html>