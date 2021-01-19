<?php

function getAllMovies(){

    $pdo=Database::getInstance()->getConnection();
    $queryAll="Select * from tbl_movies";
   
    $runAll=$pdo->query($queryAll);
    $movies=$runAll->fetchAll(PDO::FETCH_ASSOC); //use fetchall to fetch the results of the SQL query

    if($movies){
        return $movies;
    }else{
        return "There was a problem accessing this info";
    }
}

