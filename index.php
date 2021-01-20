<?php
    
    //  ini_set('display_errors',1);

     require_once './config/database.php';
     require_once './admin/scripts/read.php';
      
     if (isset($_GET['filter'])){
         $filter = $_GET['filter'];
         $getMovies = getMoviesByGenre($filter);
     } else {
         $getMovies=getAllMovies();//call the function from read.php, assign what returned to a new variable call $getMovies
      }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>This is movie CMS project.</title>
</head>

<body>
       <header>
       <h2>This content could be your nav</h2>
       <ul class="filterNav">
            <li><a href="index.php?filter=action">Action</a></li>
            <li><a href="index.php?filter=comedy">Comedy</a></li>
            <li><a href="index.php?filter=family">Family</a></li>
            <li><a href="index.php">All</a></li>
       </ul>
       </header>
       
       <!--repute code x times each one for each movie-->
       <?php foreach ($getMovies as $movie) : ?>

         <!--in PHP, if want to put HTML between two PHP tags, the best practie is not using bracket{} instead use colon : -->
         <!-- $movie['match the column'] -->
         <div class="movie-item">
             <img src="images/<?php echo $movie['movies_cover'];?>" alt="<?php echo $movie['movies_title'];?> Cover Image">
            <h3><?php echo $movie['movies_title'];?></h3>
            <h4>Movies Released : <?php echo $movie['movies_release'];?></h4>

            <a href=details.php?id=<?php echo $movie['movies_id'];?>>More detail...</a>

            <h4>Movies Runtime : <?php echo $movie['movies_runtime'];?></h4>
            <h4>Genre: <?php echo $movie['genre_name'];?></h4>
            <p><?php echo $movie['movies_storyline'];?></p>
         </div>
         
       <?php endforeach?>


       <footer>
           <p>Copyright © <?php echo date('Y');?> Zhu Meng</p> <!--Y is year-->
       </footer>

</body>
</html>