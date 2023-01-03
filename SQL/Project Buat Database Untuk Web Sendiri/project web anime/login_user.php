<?php 

session_start();

require 'function.php';

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];
  

  $result = mysqli_query($conn, "SELECT username FROM user2 WHERE id = $id");
  $row = mysqli_fetch_assoc($result);


  if ($key === hash('sha256', $row['username'])) {
    $_SESSION['login'] = true;

  }


}


if (isset($_SESSION["login"])) {
  header("Location: index_user.php");
  exit;
}

 


if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $level = $_POST["level"];
  
  $result = mysqli_query($conn, "SELECT * FROM user2 WHERE username = '$username' and level='user'");


  if(mysqli_num_rows($result) === 1 ){

    $row = mysqli_fetch_assoc($result);
    if(password_verify($password, $row["password"])){

      $_SESSION["login"] = true;
      $_SESSION["popup"] = "$username";

      if (isset($_POST['remember'])) {

        setcookie('id' , $row['id'], time()+60);

        setcookie('key' , hash('sha256', $row['username']), time()+60);//key => username
        setcookie('popup', $row['username'], time()+60);
      }


      if($level=="admin"){
     

        $_SESSION['username'] = $username;
        $_SESSION['level'] = "admin";

        header("location:index_admin.php");
     

      }else if($level=="user"){

        $_SESSION['username'] = $username;
        $_SESSION['level'] = "user";
 
        header("location:index_user.php");
     
      
     
      }else{

        exit;
      } 

      exit;
    }

    



  }

  $error = true;



}







 ?>
<!doctype html>
<html lang="en">
<head>
   <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">

    <title>FORM LOGIN</title>
</head>
<body >
  <?php if(isset($error)) : ?>
    <script>
          alert('data ada yang salah!')
        </script>
  <?php endif; ?>
  <div class="bg-image"></div>
  <div class="container bg-dark login">
    <div class="text-center text-white main-teks">FORM LOGIN</div>
    <hr class="garis">
    <form action="" method="post">
      <input type="hidden" name="level" value="user">
      <div class="form-group  text-white">
        <label for="">Username</label>

        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-user"></i></div>
          </div>
            <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan User Name Anda" autofocus required>
        </div>
      </div>
      <div class="form-group  text-white">
        <label for="">Password</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
          </div>
        <input type="Password" name="password" id="password" class="form-control" placeholder="Masukkan User Password Anda..."  required>
        </div>
      </div>
      <div class="text-center mb-3 mt-3">
        <button type="submit" name="login" class="btn btn-primary mr-2 mt-3">LOGIN</button>
        <button type="reset" class="btn btn-danger ml-2 mt-3">RESET</button>
      </div>
      
      <div class=" text-center"><a href="registrasi.php">signup?</a></div>
      <div class="text-white text-center"><input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember me</label></div>

    </form>
  </div>

  
  <!-- javascript -->
    <script type="text/javascript" src="js/popper.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>