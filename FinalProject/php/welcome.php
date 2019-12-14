<?php
  session_start();
   $user = $_SESSION["phone"];
   $pass = $_SESSION["pass"];
  echo "$user"."$pass";
 ?>
