<?php 
function addMovie($movie){
    try{

         // return 'you are about to create a new movie!'.PHP_EOL.var_export($movie, true);
         # 1. connect to database
        $pdo = Database::getInstance() -> getConnection();

         # 2. validate the file upload
         $cover = $movie['cover'];//get movie cover
         $upload_file = pathinfo($cover['name']);//return information about a path using an associative array or a string
         $accepted_types = array('gif', 'jpg', 'jpe', 'jpeg', 'png', 'svg');//define accepted file types
         
        
         //if uploaded file type deesnt belong to accetped types, throw a error message and stop heres
         if(!in_array($upload_file['extension'], $accepted_types)){
                throw new Exception(" Wrong file type !"); 
                //in try block, if throw a new exception,  code gonna stop here and jump to catch section
         }


         # 3. move the uploaded file around (move the file from tmp path to the /images
         $image_path          = '../images/';//destination: where we add the cover file
         // hiding the original file name  //generated file name rather than use filename directly
         $generated_name      = md5($upload_file['filename'] . time());
          //put the original file name and join with timestamp and then put md5 to hash it, once it hashed, there is not readble info from the file name anymore, 
         $generated_filename  = $generated_name . '.' . $upload_file['extension'];
         $target_path         = $image_path . $generated_filename;

         # if move cover to image folder fail
         if (!move_uploaded_file($cover['tmp_name'], $target_path)) {
            throw new Exception('Failed to move uploaded file, check permission!');
        }


         # Generate an thumbnail from the original image
         $th_copy = $image_path . 'TH_' . $cover['name'];
         if (!copy($target_path, $th_copy)) {
             throw new Exception('Whoooops, that thumbnail copy did not work!!');
         }

         # 4. inset into database(tbl_movies) 
         $insert_movie_query    = 'INSERT INTO tbl_movies(movies_cover, movies_title, movies_year, movies_runtime, movies_storyline, movies_trailer, movies_release)';
         $insert_movie_query   .= ' VALUES(:cover, :title, :year, :runtime, :storyline, :trailer, :release)';
         $insert_movie          = $pdo -> prepare($insert_movie_query);
         $insert_movie_result   = $insert_movie -> execute(
             array(
                ':cover'     =>$generated_filename,
                ':title'     =>$movie['title'],
                ':year'      =>$movie['year'],
                ':runtime'   =>$movie['runtime'],
                ':storyline' =>$movie['storyline'],
                ':trailer'   =>$movie['trailer'],
                ':release'   =>$movie['release']
                  )
             );
             
             ##UPDATE genre to another table
             ## Only when the inset want through, we add the newly created movie to the proper genre
             $last_updated_id = $pdo -> lastInsertId();
             if(!empty($last_updated_id) && $insert_movie_result){
                 ## movies_id from  $insert_movie_query ##genre_id from user select
                 $update_genre_query  = 'INSERT INTO tbl_mov_genre(movies_id, genre_id) VALUES (:movies_id, :genre_id)';
                 $update_genre = $pdo -> prepare($update_genre_query);
                 $update_genre -> execute(
                     array(
                        ':movies_id' => $last_updated_id,
                        ':genre_id'  => $movie['genre']
                     )
                 );
             }


             # 5. if all of above, redirect user to index.php
             redirect_to('index.php');

    }catch(Exception $e){//section throw will be the section catch
        # Return the erro message -> Wrong file type !
        $error = $e ->getMessage();
        return $error;

    }
   
  
}


function getAllMovieGenres(){
    $pdo = Database::getInstance() -> getConnection();

    $get_all_genre_query = 'SELECT * FROM tbl_genre';
    $genres = $pdo ->query($get_all_genre_query);

    if($genres){
         return $genres;
    }else{
        return false;
    }
}