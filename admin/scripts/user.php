<?php
//drop down menu
function getUserLevelMap(){
    return array(
        '0' => 'Web Editor',
        '1' => 'Web Admin',
        '2' => 'Web Admin Super Admin',
    );
}

//display user level on dashboard
function getCurrentUseLevel(){
    $user_level_map = getUserLevelMap();
    if(isset($_SESSION['user_level']) && array_key_exists($_SESSION['user_level'], $user_level_map)){
        // array_key_exists will check $_SESSION['user_level'] whether exist in array $user_level_map for not
        return $user_level_map[$_SESSION['user_level']];
    }else{
        return "unrecognized";
    }
}

//add new user to database
function createUser($user_data){
    ##testing only, remove it later
    // return var_export($user_data, true);
    $pdo = Database::getInstance() -> getConnection();

    $create_user_query = 'INSERT INTO tbl_user(user_fname, user_name, user_pass, user_email, user_level)';
    $create_user_query .= ' VALUE(:fname, :username,:password, :email, :user_level) '; //use placeholder prevent SQL injection

  
    //return $create_user_query;
    ## 1. Run the proper SQL query, insert user into tbl_user
    $create_user_set = $pdo -> prepare($create_user_query);
    $create_user_result = $create_user_set -> execute(
        array(
          ':fname'      =>$user_data['fname'],
          ':username'   =>$user_data['username'],
          ':password'   =>$user_data['password'],
          ':email'      =>$user_data['email'],
          ':user_level' =>$user_data['user_level'],
        )
    );
    ## 2. Redirect to index.php if create user successfully, mayber leave some message to user? 
    ## Otherwise, showing error message
    if($create_user_result){
        redirect_to('index.php');
    }else{
        return 'The user did not go through!!!';
    }
}


function getSingleUser($user_id){
    // echo 'you are try to fetch user :'.$user_id;
    $pdo = Database::getInstance() -> getConnection();

    $get_user_query = 'SELECT * FROM tbl_user WHERE user_id = :id';//SQL placeholder to aviod SQL injection
    $get_user_set = $pdo ->prepare($get_user_query);
    $get_user_result = $get_user_set -> execute(
        array(
            ':id' => $user_id
        )
        );

    if($get_user_result && $get_user_set ->rowCount()){
        return $get_user_set;
    }else{
        return false;
    }
}

function editUser($user_data){
    $pdo = Database::getInstance() -> getConnection();

    $update_user_query = 'UPDATE tbl_user SET user_fname = :fname, user_name = :username, user_pass = :password, user_email = :email, user_level = :user_level WHERE user_id = :id';
    $update_user_set = $pdo ->prepare($update_user_query);
    $update_user_result = $update_user_set -> execute(
        array(
          ':fname'      =>$user_data['fname'],
          ':username'   =>$user_data['username'],
          ':password'   =>$user_data['password'],
          ':email'      =>$user_data['email'],
          ':user_level' =>$user_data['user_level'],
          ':id'         =>$user_data['id'],
            
        )
    );

    //its a legit SQL query you want, some error?
    $update_user_set -> debugDumpParams();
    exit;

    if($update_user_result){
        redirect_to('index.php');
    }else{
        return 'The user update not go through!!!';
    }

}