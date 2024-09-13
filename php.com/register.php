<?php
    include"service/database.php";
    session_start();

    $register_message = "";

    if(isset($_SESSION["is_login"])) {
      header("location: dashboard.php");
  }

    if(isset($_POST["register"])){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $hash_password = hash("md5",$password);

        try {
          $sql = "INSERT INTO tbitoya (username, email, password) VALUES ('$username', '$email', '$hash_password')";
  
          if($db->query($sql)) {
              $register_message = "daftar akun berhasil, silahkan login";
          }else{
              $register_message = "daftar akun gagal, silahkan coba lagi";
          }
        }catch (mysqli_sql_exception) {
            $register_message = "email sudah ada, silahkan ganti yang lain";
        }
        $db->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php include "layout/header.html" ?>

  <h3>DAFTAR AKUN</h3>
  <i><?= $register_message  ?></i>
  <form action="register.php" method="POST">
    <input type="text" placeholder="username" name="username"/>
    <input type="text" placeholder="email" name="email"/>
    <input type="password" placeholder="password" name="password"/>
    <button type="submit" name="register">daftar sekarang</button>
  </form>

  <?php include "layout/footer.html" ?>
</body>
</html>