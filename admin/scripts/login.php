<!-- for any helper functions for login/log out -->
<?php
function login($username, $password, $ip) {

    ## TODO remove the following debug when done
    //return 'You are trying to login with Username:'.$username.'Password:'.$password;

    //database connecters
    $pdo = Database :: getInstance() -> getConnection();
    #TODO: Finish the following query to check if the username and passowrd are matching in DB
    $get_user_query = ' SELECT * FROM tbl_user  WHERE user_name = :username AND user_pass = :password ';
    $user_set = $pdo -> prepare($get_user_query);
    $user_set -> execute(
        array(
            ':username' => $username,
            ':password' => $password
        )
    );

    if($found_user = $user_set -> fetch(PDO::FETCH_ASSOC)){//PDO::FETCH_ASSOC tells PDO to return the result as an associative array.
       //if found user exist in user database, get him in!

        $found_user_id = $found_user['user_id'];//get user id

        //update the user IP by the curren logged in one
        $update_user_query = 'UPDATE tbl_user SET user_ip = :user_ip WHERE user_id = :user_id';
        $update_user_set = $pdo -> prepare($update_user_query);
        $update_user_set -> execute(
            array(
                ':user_ip' => $ip,
                ':user_id' => $found_user_id
            )
        );

       ##TODO : debug only, will change here
       //return 'Hello, ' . $username . '!  <br />  Your IP address (using $_SERVER[\'REMOTE_ADDR\']) is ' . $ip . '<br /><br />';
       
       //after login in succes, redirect user back to index.php, redirect_to function
       redirect_to('index.php');

    }else{

       //this is invaild attemp, reject it!
       return "Sorry, your username or password isn't correct. Please try again!";
    }
}
