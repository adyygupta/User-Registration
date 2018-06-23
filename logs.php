<?php

if(isset($_POST['login_user'])){
$user = $_SERVER['login_user'];
$filename ="";
$msg="";
// open a file
$file = fopen($filename,"logs.txt");
// append date/time to message
$str = "[" . date("Y/m/d h:i:s", mktime()) . "] " . $msg;

// write string
fwrite($file,$user,$str ."\n");
echo "Your user has been logged";
fclose($file);
}else{
  echo "Not logged";
}




?>
