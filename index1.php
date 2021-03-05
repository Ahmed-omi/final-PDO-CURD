<?php
session_start();
try{
$con = new PDO ("mysql:host=localhost;dbname=educate","root","narbonne12");
if(isset($_POST['signup'])){
 $name = $_POST['name'];
 $email = $_POST['email'];
 $pass = $_POST['pass'];
 //$date = $_POST['date'];
 //$month = $_POST['month'];
// $year = $_POST['year'];

 $insert = $con->prepare("INSERT INTO users (name,email,pass)
values(:name,:email,:pass) ");
$insert->bindParam(':name',$name);
$insert->bindParam(':email',$email);
$insert->bindParam(':pass',$pass);
//$insert->bindParam(':month',$month);
$insert->execute();
}elseif(isset($_POST['signin'])){
 $email = $_POST['email'];
 $pass = $_POST['pass'];

 $select = $con->prepare("SELECT * FROM users WHERE email='$email' and pass='$pass'");
 $select->setFetchMode(PDO::FETCH_ASSOC);
 $select->execute();
 $data=$select->fetch();
 if($data['email']!=$email and $data['pass']!=$pass)
 {
  echo "invalid email or pass";
 }
 elseif($data['email']==$email and $data['pass']==$pass)
 {
 $_SESSION['email']=$data['email'];
    $_SESSION['name']=$data['name'];
header("location:index.php");
 }
 }
}
catch(PDOException $e)
{
echo "error".$e->getMessage();
}
?>

<div style="width:500px ; height:600px; float:left;">
<div style="padding:85px;">
<h1>Create Account Here</h1>
<form method="post">
<input type="text" name="name" placeholder="User Name"><br><br>
<input type="text" name="email" placeholder="example@example.com"><br><br>
<input type="text" name="pass" placeholder="**********"><br><br>


<input type="submit" name="signup" value="SIGN UP">
</form>
</div>
</div>
<div style="width:500px ; float:right; height:600px;">
<div style="padding:85px;padding-right:200px;">

<h1>Log In Here</h1>
<form method="post">
<input type="text" name="email" placeholder="example@example.com"><br><br>
<input type="text" name="pass" placeholder="**********"><br><br>
<input type="submit" name="signin" value="SIGN IN">
</div>
</div>
