<?php

$host = "localhost"; 
$user = "root"; 
$pass = ""; 
$db = "test"; 

$sock = mysql_connect($host, $user, $pass) or die ("연결에러");
$database = mysql_select_db($db,$sock) or die ("테이블에러");
function execute_query($query) {

    $r = mysql_query($query);

    if (!$r) {
        echo "Cannot execute query: $query\n";
        trigger_error(mysql_error()); 
    } else {
        echo "Query: $query executed\n"; 
    }
}

