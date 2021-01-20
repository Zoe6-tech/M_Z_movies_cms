<?php
define('ABSPATH',__DIR__);//php will detect the director where is being called and save as a constant
//  ini_set('display_errors',1); or change 1 to 0
ini_set('display_errors', 0);
    
require_once ABSPATH. '/config/database.php';
require_once ABSPATH. '/admin/scripts/read.php';