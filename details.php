<?php
     require_once 'load.php';
    
    //  $movie=getSingleMovie(1);//test $id = 1  

     if(isset($_GET['id'])){
         $id=$_GET['id'];
        $movie=getSingleMovie($id);//test $id = 1        
     }

?>
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Page</title>
</head>

<body>
      
       <?php include 'templates/header.php' ?>
       
       <!--------------------show only one movies at one time--------------------->

       <?php if(!empty($movie)): ?>

         <div class="movie-item">
             <img src="images/<?php echo $movie['movies_cover'];?>" alt="<?php echo $movie['movies_title'];?> Cover Image">
            <h3><?php echo $movie['movies_title'];?></h3>
            <h4>Movies Released : <?php echo $movie['movies_release'];?></h4>
            <h4>Movies Runtime : <?php echo $movie['movies_runtime'];?></h4>
            <p><?php echo $movie['movies_storyline'];?></p>
         </div>
       
       <!--if movie_id doesn't exist-->
       <?php else:?>
       <p>There isn't such a movie.</p>

       <?php endif?>


       <?php include 'templates/footer.php' ?>

</body>
</html>