<?php include('server.php') ?>
<table width="400" border="0" cellspacing="1" cellpadding="0">
<tr>
<td><form name="form2" method="post" action="">
  <?php include('errors.php'); ?>
<table width="400" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td align="center" bgcolor="#FFFFFF">S.No.</td>
<td align="center" bgcolor="#FFFFFF"><strong>Username</strong><br /><input type="text" name="u_name" id="u_name"></td>
<td align="center" bgcolor="#FFFFFF"><strong>First Name</strong><br /><input type="text" name="f_name" id="f_name"></td>
<td align="center" bgcolor="#FFFFFF"><strong>Last name</strong><br /><input type="text" name="l_name" id="l_name"></td>
<td align="center" bgcolor="#FFFFFF"><strong>Email</strong><br /><input type="text" name="email" id="email"></td>
</tr>
<button class="btn_search" name="search_user" type="submit" onclick="">SEARCH</button>

<?php
//Adding a comment
$query1 = "SELECT username, firstname, lastname, email FROM users";
// receive all input values from the form
if(isset($_POST['search_user'])){
  $username = mysqli_real_escape_string($db, $_POST['u_name']);
  $firstname = mysqli_real_escape_string($db, $_POST['f_name']);
  $lastname = mysqli_real_escape_string($db, $_POST['l_name']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $count = 0;
  if(!empty($username)){
  $query1 = $query1 . " WHERE username LIKE '%" .$username. "%'";
  //$query2 = $query1 . "$username" . 'WHERE username LIKE '%'';
  //$result1 = mysql_fetch_array($query2);
  $count++;
}
if(!empty($firstname)){
  if ($count == 0) {
    $query1 = $query1 . " WHERE firstname LIKE '%" .$firstname. "%'";
  } else {
    $query1 = $query1 . " AND firstname LIKE '%" .$firstname. "%'";
  }//$query2 = $query1 . "$firstname" . 'WHERE firstname LIKE '%'' ;
  //$result1 = mysql_fetch_array($query2);
  $count++;
}
if(!empty($lastname)){
  if($count == 0) {
    $query1 = $query1 . " WHERE lastname LIKE '%" .$lastname. "%'";
  } else {
    $query1 = $query1 . " AND lastname LIKE '%" .$lastname. "%'";
  }
  //$query2 = $query1 . "$lastname" . 'WHERE lastname LIKE '%'';
  //$result1 = mysql_fetch_array($query2);
  $count++;
}
if(!empty($email)){
  if($count == 0) {
    $query1 = $query1 . " WHERE email LIKE '%" .$email. "%'";
  } else {
    $query1 = $query1 . " AND email LIKE '%" .$email. "%'";
  }
  //$query2 = $query1 . "$email" . 'WHERE email LIKE '%'';
  //$result1 = mysql_fetch_array($query2);
  $count++;
}
}
$result1 = mysql_fetch_array($query1);
  echo $i=1;
  foreach($result1 as $rows) {?>
    <tr>
      <td bgcolor="#FFFFFF"><? echo $i++ ?></td>
      <td bgcolor="#FFFFFF"><? echo $rows['username']; ?></td>
      <td bgcolor="#FFFFFF"><? echo $rows['firstname']; ?></td>
      <td bgcolor="#FFFFFF"><? echo $rows['lastname']; ?></td>
      <td bgcolor="#FFFFFF"><? echo $rows['email']; ?></td>
    </tr>
<?} ?>
</table>
</form>
</td>
</tr>
</table>
