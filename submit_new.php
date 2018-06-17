<?php
if(isset($_POST['submit_password']) && $_POST['key'] && $_POST['reset'])
{
  $email=$_POST['email'];
  $pass=$_POST['password'];
  $db = mysqli_connect('localhost', 'root', '', 'registration');
  $query= "UPDATE users SET password='$password' WHERE email='$email'";
  $results = mysqli_query($db, $query);
}
?>
