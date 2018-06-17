<?php
if($_GET['key'] && $_GET['reset'])
{
  $email=$_GET['key'];
  $pass=$_GET['reset'];
  $db = mysqli_connect('localhost', 'root', '', 'registration');
  $query= "SELECT email, password FROM users WHERE md5(email)='$email' AND md5(password)='$pass'";
  $results = mysqli_query($db, $query);
  if(mysql_num_rows($results)==1)
  {
    ?>
    <form method="post" action="submit_new.php">
    <input type="hidden" name="email" value="<?php echo $email;?>">
    <p>Enter New password</p>
    <input type="password" name='password'>
    <input type="submit" name="submit_password">
    </form>
    <?php
  }
}
?>
