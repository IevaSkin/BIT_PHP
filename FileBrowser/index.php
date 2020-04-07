<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Failu narsykle</title>
</head>
<body>
    <h1 class="h1">Directory contents:</h1>
    <table class="lentele" style="width:80%">
    <tr class="lentele2">
    <th>Type</th>
    <th>Name</th>
    <th>Actions</th>
    </tr>
    <tr>
    <td>Directory</td>
    <td></td>
    <td></td>
    </tr>
    <tr>
    <td>File</td>
    <td></td>
    <td></td>
    </tr>
    <td>File</td>
    <td></td>
    <td></td>
    </tr>
</body>

<?php 
// specifying directory 
$mydir = '/BIT_PHP'; 
  
//scanning files in a given diretory in ascending order 
$myfiles = scandir($mydir); 
  
//displaying the files in the directory 
print_r($myfiles); 
?> 

</html>