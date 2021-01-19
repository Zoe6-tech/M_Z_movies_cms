<?php
//test.php is about function to measure of performance
include_once 'config/database_old.php';//old
include_once 'config/database.php';//new

//---------------------------------------------------------------------------------------------------------------
# 1. take snapshot of current timestamp
$start = microtime(true); //microtime — Return current Unix timestamp with microseconds
//tell php starting at this point, measure the time for the follow execution


# 2.  and then run follow code(repeat 100 times)
//repeat 100 times db connections in PHP
$i=0;
while($i<1000){
    $database = new Database_old();// class name
    $db=$database->getConnection();
    $i++;
}
//each connection cost very little time, make the measurement be actually accurate, gonna repeat 100 times
//those times add together, normalize the measurements


# 3. then take other snapshot again, calculate the different, 
#   so we can know $time_cal variable containes the duration for PHP to executing those lines which is loading database connection for 100 times
$old_time_cal=microtime(true) - $start;

//---------------------------------------------------------------------------------------------------------------
//run the new code
$start = microtime(true);
$i=0;
while($i<1000){
    $database =Database::getInstance();//only differet here
    $db=$database->getConnection();
    $i++;
}
$new_time_cal=microtime(true) - $start;


//---------------------------------------------------------------------------------------------------------------
# 4. make result visible
printf('DB Old Connection Cal ===> %s ms'.PHP_EOL, $old_time_cal * 1000);  //microsecond(ms) is unit, so *1000
// http://localhost/M_Z_movies_cms/test.php should be abole to see :  DB Old Connection Cal ===> 1463.11211586 ms 
printf('DB New Connection Cal ===> %s ms'.PHP_EOL, $new_time_cal * 1000);  //EOL: end of line

//---------------------------------------------------------------------------------------------------------------
## 5. Show result-compare
$different = ($old_time_cal - $new_time_cal) / 1000;
$percentage = ($new_time_cal / $old_time_cal) * 100;

printf('You saved %s ms per connection'.PHP_EOL, $different * 1000);
printf('New connection only takes %s%% of Old connection'.PHP_EOL, $percentage );