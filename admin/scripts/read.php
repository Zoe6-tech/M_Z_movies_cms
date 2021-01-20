<?php
//read.php page
function getAllMovies(){

    $pdo=Database::getInstance()->getConnection();
    $queryAll="SELECT * FROM tbl_movies";
   
    $runAll=$pdo->query($queryAll);
    $movies=$runAll->fetchAll(PDO::FETCH_ASSOC); //use fetchall to fetch the results of the SQL query

    if($movies){
        return $movies;
    }else{
        return "There was a problem accessing this info";
    }
}


//details.php page
function getSingleMovie($id){

    $pdo=Database::getInstance()->getConnection();
    //only one
    $querySingle="SELECT * FROM tbl_movies WHERE movies_id= ". $id ." ";
   
    $runSingle=$pdo->query($querySingle);
   
    if($runSingle){
        $movie=$runSingle->fetch(PDO::FETCH_ASSOC); 
        return $movie;
    }else{
        return "There was a problem to fetch single movie for".$id;
    }
}

    function getMoviesByGenre($genre){

        $pdo = Database::getInstance()->getConnection();
        $query ='SELECT m.*,GROUP_CONCAT(g.genre_name) as genre_name ';
        $query .='FROM tbl_movies m';
        $query .=' left join  tbl_mov_genre mg  on  mg.movies_id = m.movies_id';
        $query .=' left join  tbl_genre g  on  mg.genre_id = g.genre_id';
        $query .=' GROUP by m.movies_id ';
        $query .=' Having genre_name LIKE "%'.$genre.'%"' ;
        ;
        
        //test query 
        // echo $query;
        // exit;

        $runQuery = $pdo->query($query);
       
        if($runQuery){
            $movies = $runQuery->fetchAll(PDO::FETCH_ASSOC); 
            return $movies;
        }else{
            return 'There was a problem to fetch movie by genre'.$genre;
        }
    }
