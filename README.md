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

# week3 : login page
proivde a form to login, reject if username or passoword not correct, reject if requirenment field is empty
* [admin_login.php](/admin/admin_login.php) : <br>