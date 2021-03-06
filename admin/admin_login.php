<?php
require_once '../load.php';

$ip = $_SERVER['REMOTE_ADDR'];//"REMOTE_ADDR" => The IP address from which the user is viewing the current page.
//we want get the value $ip, and add it in login() as the third parameter

//gain username and password, empty check
if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']); //The trim() function removes whitespace and other predefined characters from both sides of a string.
    
    if(!empty($username) && !empty($password)){//if username and password both not empty
        $result = login($username, $password, $ip);//allow login, login function in login.php
        $message = $result;
    }else{
        $message = 'Plesase fill out the request field';
    }
}

//if user already log in, redirect user to index.php, dont allow login in user access admin_login.php again
if(isset($_SESSION['user_id'])){
    redirect_to('index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the admin panel</title>
</head>
<body>
    <?php echo !empty($message)?$message:'';?> <!--if $message isnt empty, print $message info-->

    <form action="admin_login.php" method="post">
       <label for="username">Username:</label>
       <input id="username" type="text" name="username" value="">
       <br><br>
       <label for="password">Password:</label>
       <input id="password" type="text" name="password" value="">
       <br><br>
       <button type="submit" name="submit">Login</button>
    </form>
</body>
</html>