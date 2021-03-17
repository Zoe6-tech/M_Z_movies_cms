# week1:  optimise code - test.php
Performance measurements and Improved DB connection
## New DB code   VS   Old DB code
DB Old Connection Cal ===> 8801.4240264893 ms<br>
DB New Connection Cal ===> 4.3110847473145 ms<br>
You saved 8.7971129417419 ms per connection<br>
New connection only takes 0.048981673128571% of Old connection<br>

# week2:  load movie
* [read.php](/admin/scripts/read.php)
1. Home Page : load all movies on index.php (no hardcode) 
2. Detail Page : only show one movie at one time base on movies_id
3. link detail page on each movie, more detail... button
4. Movies filtered by Genre
5. Dont repeat code : two way
* [templates](/templates) :<br>
```<?php include 'templates/header.php' ?>```<br>
```<?php include 'templates/footer.php' ?>```<br>

* [load.php](/load.php) : <br>
```require_once 'load.php';```<br>

6. redirect all pages to home page (index.php) OR deny user access
if people accidently or on purpose go back end pages such as load.php,header.php... just take those people to the home
* Apache HTTP access syntax

##  test and debugger code example
 <br>
 <?php   <br>
   var_dump($getMovies);   //var_dump is you can check what is inside of this variable $getMovies<br>
   exit;    //terminate PHP writing here, no line after exit will be execute<br>
 ?>

# week3 : add login page
proivde a form to login, reject if username or passoword not correct, reject if requirenment field is empty<br>
Normal forms can be sent directly using GET, while confidential information must be handled using POST, such as the login account password of the member.
* [admin_login.php](/admin/admin_login.php) : <br>



# week4 : sessoin is a great concept that make the back and the life way easier
## login user to dashborad page
* validata user input: not empty, need correct and match each other
* If username and password are correct and match each other
* need user_ip : $ip = $_SERVER['REMOTE_ADDR'];, update it on DB
* redirect user to index.php page :  redirect_to() function 

## session & cookie : session_start()
* server can remember user browser  -  save time, benefit user
* Server create a session(logger), session need unique for each user browser
* Session would store something temporay on the server will faster all those authentication going forward
* When user log out, session delete  : session_destory()
* If user not active for a while, session 

## session id check
Network->Cookies->PHPSESSID	"eismosan1j076bt8psdbq197hh"

## session will check - login logout redirect
* only login in user can see the index.php page
* if user already log in, redirect user to index.php, dont allow login in user access admin_login.php again
* if people didnt log in, they cannot log out


# Week5: Create a user functionality within CMS
* create user 
* user squal injection can damage every thing

* use placeholder prevent SQL injection 


# Week6:admin-user level
* two type of user : admin VS editor
1. restrict the create user only by admin ==> how do we make it more general? or resuseable?
2. redirect editor away from create user page ==> reuseable?
* function getUserLevelMap() , getCurrentUseLevel()
3. display the user level to our dashboard page
4. 

# Week7:  
1. load user info on edit user page
2. user can updata their user info
3. username validation, edit / create

# Week8:
1. admin delete single user

