<?php include("logs.txt"); ?>
<?php
   function logToFile($filename, $msg)
   {
   // open file
   $fd = fopen($filename, "logs.txt");
   // append date/time to message
   $str = "[" . date("Y/m/d h:i:s", mktime()) . "] " . $msg;
   // write string
   fwrite($fd, $str . "\n"); 
   // close file
   fclose($fd);
   }
   ?>
