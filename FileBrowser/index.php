<!DOCTYPE html>
<html lang="en">
<head>
   <title>Login</title>
</head>
<body>
   <h2>Enter Username and Password</h2>
   <div>
      <form action="" method="post">
         <h4><?php echo $msg; ?></h4>
         <input type="text" name="username" placeholder="username = Ieva" required autofocus></br>
         <input type="password" name="password" placeholder="password = 01234" required>
         <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>
      </form>
   </div>
</body>
</html>

<?php
session_start();

if ($_SESSION['logged_in'] == true) {
   print('<h1>You can only see this if you are logged in!</h1>');
}
$msg = '';
if (
   isset($_POST['login'])
   && !empty($_POST['username'])
   && !empty($_POST['password'])
) {
   if (
      $_POST['username'] == 'Ieva' &&
      $_POST['password'] == '01234'
   ) {
      $_SESSION['logged_in'] = true;
      $_SESSION['timeout'] = time();
      $_SESSION['username'] = 'Ieva';
      echo 'Your login was succesful';
   } else {
      $msg = 'Wrong username or password';
   }
}

if (isset($_GET['action']) and $_GET['action'] == 'logout') {
   session_start();
   unset($_SESSION['username']);
   unset($_SESSION['password']);
   unset($_SESSION['logged_in']);
   print('Logged out!');
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
$path = './' . $_GET["path"];
$files_and_dirs = scandir($path);

print('<h1>Directory contents: ' . str_replace('?path=/', '', $_SERVER["REQUEST_URl"]) . '</h1>');
print('<table><th>Type</th><th>Name</th><th>Actions</th>');
foreach ($files_and_dirs as $fnd) {
   if ($fnd != ".." and $fnd != ".") {
      print('<tr>');
      print('<td>' . (is_dir($path . $fnd) ? "Directory" : "File") . '</td>');
      print('<td>' . (is_dir($path . $fnd)
         ? '< a href="' . (isset($_GET["path"])
            ? $_SERVER["REQUEST_URl"] . $fnd . '/'
            : $_SERVER["REQUEST_URl"] . '?path=' . $fnd . '/') . '">' . $fnd . '<a/>'
         : $fnd)
         . '</td>');
      print('<td></td>');
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
   Click here to <a href="index.php?action=logout"> logout.
</body>
</html>