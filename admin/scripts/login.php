<!-- for any helper functions for login/log out -->
<?php
function login($username, $password, $ip) {

    ## TODO remove the following debug when done
    //return 'You are trying to login with Username:'.$username.'Password:'.$password;

    //database connecters
    //login in
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

        //write the username and userID into session
        $_SESSION['user_id'] = $found_user_id;
        $_SESSION['user_name'] = $found_user['user_fname'];
        $_SESSION['user_level'] = $found_user['user_level'];

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
       return "Sorry, your username or password isn't correct. Please try again or sign in first.";
    }
}


//only login in user can see the index.php, otherwise, rediect to login page
function confirm_logged_in($admin_above_only = false){
    if(!isset($_SESSION['user_id'])) {
        redirect_to('admin_login.php');//redirect non-login user to login page 
    }
    //editor dont have access to create user page
    if(!empty($admin_above_only) && empty($_SESSION['user_level'])){
        redirect_to('index.php');//for login user if not admin level 
    }
}


//if user log out, redirect user to admin_login.php
function logout(){
    session_destroy();
    redirect_to('admin_login.php');
}