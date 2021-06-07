<?php
session_start();
$username = "";
$email    = "";
$errors = array();
$personal= "";
$work="";

$db = mysqli_connect('localhost', 'root', '', 'registration');

// REGISTER USER
if (isset($_POST['reg_user'])) {

  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);


  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }


  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) {
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password)
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: entry.php');
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
  	  header('location: entry.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

//Diaryentry
if (isset($_POST['submit'])){
$personal = mysqli_real_escape_string($db, $_POST['personal']);
$work = mysqli_real_escape_string($db, $_POST['work']);
$username = $_SESSION['username'];
	$query = "SELECT * FROM users WHERE username='$username'";
  	$results=mysqli_query($db, $query);
  $user_id=mysqli_fetch_assoc(	$results)['id'];
  $query = "INSERT INTO thought (personal,work, u_id)   VALUES('$personal', '$work', '$user_id')";
  mysqli_query($db, $query);
  header('location: display.php');
}
function displaydata($uname, $value){
        global $db;


          $uid_result = mysqli_query($db, "SELECT * FROM users WHERE username='$uname'");
            $user_id = mysqli_fetch_assoc($uid_result)['id'];
            $display_result = mysqli_query($db, "SELECT * FROM thought WHERE u_id='$user_id' ");
            echo mysqli_fetch_assoc($display_result)[$value];

   }
?>
