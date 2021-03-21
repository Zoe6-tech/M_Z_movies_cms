<?php
require_once '../load.php';

//make sure this page only access to 
confirm_logged_in();

## 1. Cover did not contain the image we picked
## 2. how did the input type="file" or $_FILES works in php 
// var_dump($_FILES);
// exit;

if(isset($_POST['submit'])){
    $data = array(
        'cover' => $_FILES['cover'],
        'title' => trim($_POST['title']),
        'year' => trim($_POST['year']),
        'runtime' => trim($_POST['runtime']),
        'trailer' => trim($_POST['trailer']),
        'release' => trim($_POST['release']),
        'storyline' => trim($_POST['storyline'])
    );

    $message = addMovie($data);
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie</title>
</head>
<body>
    <h2>Add Movie</h2>
    <?php echo !empty($message)?$message:'';?> <!--if $message isnt empty, print $message info-->
     
     <form  action="admin_addmovie.php"  method="post"  enctype="multipart/form-data" >
     <label for="cover">Cover Image:</label><br>
        <input type="file" name="cover"  id="cover" ><br><br>

        <label for="title">Movie Title:</label><br>
        <input type="text" name="title"  id="title" ><br><br>

        <label for="year">Movie Year:</label><br>
        <input type="text" name="year"  id="year" ><br><br>

        <label for="runtime">Movie Runtime:</label><br>
        <input type="text" name="runtime"  id="runtime" ><br><br>

        <label for="trailer">Movie Trailer:</label><br>
        <input type="text" name="trailer"  id="trailer" ><br><br>

        <label for="release">Movie Release:</label><br>
        <input type="text" name="release"  id="release" ><br><br>

        <label for="storyline">Movie Storyline:</label><br>
        <textarea  name="storyline"  id="storyline" ></textarea><br><br>

        <button type="submit" name="submit">Add Movie</button>
        <a href="index.php">Back</a>

     </form>
    
</body>
</html>