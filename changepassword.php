<?php
session_start();
$username = $_SESSION['username'];
if($username){
  // user is looged in
  if ($_POST['submit']){
    // Check fields
    $oldpassword = md5($_POST['oldpassword']);
    $newpassword = md5($_POST['newpassword']);
    $confirmpassword = md5($_POST['confirmpassword']);

    // coonect db
    $db = mysqli_connect('localhost', 'root', '', 'registration');
    $query = "SELECT password FROM users WHERE username ='$username'";
    $result=mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);

    $oldpassworddb = $row['password'];

    // check password

    if($oldpassword==$oldpassworddb) {
      // now check new password
      if($newpassword==$confirmpassword) {
        // success
        // now change password in db
        $query1 = "UPDATE users SET password='$newpassword' WHERE username='$username'";
        $result1=mysqli_query($db, $query1);
        session_destroy();
        echo "Your password has been changed.<a href='login.php'>Return</a>to the Login page.";
        mysqli_close($db);
      } else {
        mysqli_close($db);
        die("New passwords do not match");
      }
    } else {
      mysqli_close($db);
      die("old password doesn't match");
    }
  } else {
  echo"
  <form action='changepassword.php' method='POST'>
    Old password: <input type='password' name='oldpassword'><p>
    New password: <input type='password' name='newpassword'><br />
    Confirm password: <input type='password' name='confirmpassword'><br />
    <input type='submit' name='submit' value='Change password'>
  </form>
  ";
}
}
else{
  die("you must logged in to change the password!");
}
