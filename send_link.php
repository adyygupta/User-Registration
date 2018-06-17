<?php
include('server.php');
if(isset($_POST['submit_email']) && $_POST['email'])
{
  $db = mysqli_connect('localhost', 'root', '', 'registration');
  $query= "SELECT email, password FROM users WHERE email='$email'";
  $results = mysqli_query($db, $query);
  if(mysqli_num_rows($results)==1)
  {
    while($row=mysql_fetch_array($query))
    {
      $email=md5($row['email']);
      $pass=md5($row['password']);
    }
    $link="<a href='www.samplewebsite.com/reset.php?key=".$email."&reset=".$pass."'>Click To Reset password</a>";
    require_once('phpmail/PHPMailerAutoload.php');
    $mail = new PHPMailer();
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    // enable SMTP authentication
    $mail->SMTPAuth = true;
    // GMAIL username
    $mail->Username = "adityajdj.gupta@gmail.com";
    // GMAIL password
    $mail->Password = "appleiwatch";
    $mail->SMTPSecure = "ssl";
    // sets GMAIL as the SMTP server
    $mail->Host = "smtp.gmail.com";
    // set the SMTP port for the GMAIL server
    $mail->Port = "465";
    $mail->From='adityajdj.gupta@gmail.com';
    $mail->FromName='Aditya';
    $mail->AddAddress('email', 'firstname');
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body    = 'Click On This Link to Reset Password '.$pass.'';
    if($mail->Send())
    {
      echo "Check Your Email and Click on the link sent to your email";
    }
    else
    {
      echo "Mail Error - >".$mail->ErrorInfo;
    }
  }
}
?>
