<?php
require_once '../load.php';
confirm_logged_in();//only login in user can see the index.php page
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the admin panel</title>
</head>
<body>
    <h2>Welcome to the dashboard page, <?php echo $_SESSION['user_name'];?>!</h2>
    <h3>You are in level: <?php echo getCurrentUseLevel();?></h3>
    
    
    <?php if(isCurrentUserAdminAbove()):?>
    <a href="admin_createuser.php">Create User</a>
    <?php endif;?>

    
    <a href="admin_logout.php">Sign Out</a><br><br>
    <a href="admin_edituser.php">Edit User</a><br><br>
</body>
</html>