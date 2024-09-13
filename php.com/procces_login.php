<?php
  include "service/database.php";
  session_start();

  $login_message = "";

  if(isset($_SESSION["is_login"])) {
      header("location: login.php");
  }

  if(isset($_POST['login'])) {
     $username = $_POST['email'];
     $password = $_POST['password'];
     $hash_password = hash("md5",$password);

     $sql = "SELECT * FROM  tbitoya WHERE email='$email' AND password='$hash_password'
     ";

     $result = $db->query($sql);

      if($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION["email"] = $data["email"];
        $_SESSION["is_login"] = true;

        header("location: index.php");

      }else{
        $login_message = "akun tidak ditemukan";
      }
      $db->close();
  }
?>