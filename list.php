<?php include('server.php') ?>
<table width="400" border="0" cellspacing="1" cellpadding="0">
<tr>
<td><form name="form1" method="post" action="">
  <?php include('errors.php'); ?>
<table width="400" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td align="center" bgcolor="#FFFFFF">S.No.</td>
<td align="center" bgcolor="#FFFFFF"><strong>Username</strong></td>
<td align="center" bgcolor="#FFFFFF"><strong>First Name</strong></td>
<td align="center" bgcolor="#FFFFFF"><strong>Last name</strong></td>
<td align="center" bgcolor="#FFFFFF"><strong>Email</strong></td>
</tr>

<?php
$query = "SELECT username, firstname, lastname, email FROM users";
$result = mysql_fetch_array($query);
$i=1;
foreach($result as $rows) {?>
  <tr>
  <td bgcolor="#FFFFFF"><? echo $i++ ?></td>
  <td bgcolor="#FFFFFF"><? echo $rows['username']; ?></td>
  <td bgcolor="#FFFFFF"><? echo $rows['firstname']; ?></td>
  <td bgcolor="#FFFFFF"><? echo $rows['lastname']; ?></td>
  <td bgcolor="#FFFFFF"><? echo $rows['email']; ?></td>
</tr>
<? } ?>
</table>
</form>
</td>
</tr>
</table>

<button class="btn_search" type="submit" onclick="location.href='search.php'">SEARCH</button>
