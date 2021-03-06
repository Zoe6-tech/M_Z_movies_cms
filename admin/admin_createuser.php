<?php
require_once '../load.php';

//make sure this page only access to 
confirm_logged_in(true);

if(isset($_POST['submit'])){
    $data = array(
        'fname' => trim($_POST['fname']),
        'username' => trim($_POST['username']),
        'password' => trim($_POST['password']),
        'email' => trim($_POST['email']),
        'user_level' => trim($_POST['user_level']),
    );

    $message = createUser($data);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User Page</title>
</head>
<body>
    <h2>Create User</h2>
    <?php echo !empty($message)?$message:'';?> <!--if $message isnt empty, print $message info-->
    <form action="admin_createuser.php" method="post">
        <label for="first_name">First Name:</label><br>
        <input type="text" name="fname"  id="first_name" placeholder="enter first name" value=""><br><br>

        <label for="user_name">User Name:</label><br>
        <input type="text" name="username"  id="user_name" placeholder="enter user name" value=""><br><br>

        <label for="password">Password:</label><br>
        <input type="text" name="password"  id="password" placeholder="enter password" value=""><br><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email"  id="email" placeholder="enter email" value=""><br><br>

        <label for="user_level">User Level:</label><br>
        <select  name="user_level"  id="user_level" >
          <?php  $user_level_map = getUserLevelMap();
           foreach($user_level_map as $val => $label): ?>
          <option value="<?php echo $val;?>"><?php echo $label;?></option>   
             <!-- <option value="0">Web Editor</option>  -->
             <!--   <option value="1">Web Admin</option>   --> 
          <?php endforeach;?>
        </select><br><br>
       

        <button type="submit" name="submit">Create user</button><br><br>
                <a href="index.php">Back</a>
    </form>
    
</body>
</html>