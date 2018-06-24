<?php
session_start();

// initializing variables
$username = "";
$firstname = "";
$lastname = "";
$email    = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'registration');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
  $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error into $errors array
  if (empty($username))
  {
    array_push($errors, "Username is required");
  }else{
    $username = trim($username);
  }
  if (empty($firstname))
  {
    array_push($errors, "firstname is required");
  }else{
    $firstname = trim($firstname);
  }
  if (empty($lastname))
  {
    array_push($errors, "lastname is required");
  }else{
    $lastname = trim($lastname);
  }
  if (empty($email))
  {
    array_push($errors, "Email is required");
  }else{
    $email = trim($email);
  }
  if (empty($password_1))
  {
    array_push($errors, "Password is required");
  }
  if ($password_1 != $password_2)
  {
    array_push($errors, "The two passwords do not match");
  }


  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, firstname, lastname, email, password)
  			  VALUES('$username', '$firstname', '$lastname', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}


// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
      $msg = $username ." logged in.";
      echo $msg;
      writeLogFile($msg);
  	  header('location: index.php');

}
    else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

function writeLogFile($msg) {
  $file = fopen("logs.txt", "r+");
  if ($file) {
    while (!feof($file)) {
      fgets($file);
    }
    // append date/time to message
    $str = "[" . date("Y/m/d h:i:s", mktime()) . "] " . $msg;
    echo fwrite($file, $str . "\r\n");
    fclose($file);
  }
}

// to get list of all users

function mysql_fetch_array($query) {
  $db = mysqli_connect('localhost', 'root', '', 'registration');
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
    return;
  }
  $finalResult = [];
  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      array_push($finalResult, $row);
      //echo "firstname: " . $row["firstname"]. " - username: " . $row["username"]. " -lastname:" . $row["lastname"]. "<br>";
    }
  } else {
    echo "0 results";
  }
  mysqli_close($db);
  //echo $finalResult;
  return $finalResult;
  /*$result = mysqli_query($db, $query);
  echo $result;
  return $result;*/
  //header('location: list.php');
}

// search users from database

function search($query1) {
  $db = mysqli_connect('localhost', 'root', '', 'registration');
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
    return;
  }
  $searchResult = [];
  $result1 = mysqli_query($db, $query1);
  if (mysqli_num_rows($result1) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result1)) {
      array_push($searchResult, $row);
      //echo "firstname: " . $row["firstname"]. " - username: " . $row["username"]. " -lastname:" . $row["lastname"]. "<br>";
    }
  } else {
    echo "0 results";
  }
  mysqli_close($db);
  //echo $finalResult;
  return $searchResult;
}
?>
