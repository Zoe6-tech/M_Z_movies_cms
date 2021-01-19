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