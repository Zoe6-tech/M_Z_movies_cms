<?php

function createUser($user_data){
    ##testing only, remove it later
    // return var_export($user_data, true);
    $pdo = Database::getInstance() -> getConnection();

    $create_user_query = 'INSERT INTO tbl_user(user_fname, user_name, user_pass, user_email)';
    $create_user_query .= ' VALUE( " '.$user_data['fname'].' ",
                                     " '.$user_data['username'].' ",
                                        " '.$user_data['password'].' ",
                                           " '.$user_data['email'].' " ) ';
  
    return $create_user_query;

    // $create_user_set = $pdo -> prepare($create_user_query);
    // $create_user_result = $create_user_set -> execute(
    //     array(

    //     )
    // );

    ## 1. Run the proper SQL query, insert user into tbl_user
    ## 2. Redirect to index.php if create user successfully, mayber leave some message to user? 
    ## Otherwise, showing error message
    ## 3. 
}

