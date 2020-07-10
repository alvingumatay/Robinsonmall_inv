<?php
  require_once 'conn.php';
  if(ISSET($_POST['edit'])){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];
    $register_date = $_POST['register_date'];
    $last_login = $_POST['last_login'];
    $notes = $_POST['notes'];
    $photo_name = $_FILES["photo"]['name'];
    $photo_tmp = $_FILES["photo"]['tmp_name'];        
    $previous = $_POST['previous'];
    $exp = explode(".", $photo_name);
    $end = end($exp);
    $name = time().".".$end;
    $path = "upload/".$name;
    $allowed_ext = array("gif", "jpg", "jpeg", "png");
    if(in_array($end, $allowed_ext)){
      if(unlink($previous)){
        if(move_uploaded_file($photo_temp, $path)){
          mysqli_query($conn, "UPDATE `user` set `username` = '$username', `email` = '$email', `password` = '$password', `usertype` = '$usertype', `register_date` = '$register_date', `last_login` = '$last_login', `notes` = '$notes',  `photo` = '$path' WHERE `id` = '$id'") or die(mysqli_error());
          echo "<script>alert('User account updated!')</script>";
          header("location: dashboard.php");
        }
      }   
    }else{
      echo "<script>alert('Image only')</script>";
    }
  }
?>
