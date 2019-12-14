<?php

function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "user";
 $dbpass = "pass";
 $db = "databaseName";
 
 
 
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }

?>
