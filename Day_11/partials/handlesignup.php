<?php
    $showError=  false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'db_connect.php';
        $user_email = $_POST['signupemail'];
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];

        $existsql = "SELECT * FROM `users` WHERE `users`.`user_email` = '$user_email'";
        $result = mysqli_query($conn,$existsql);
        $numRows = mysqli_num_rows($result);
        if($numRows>0){
            $showError = "Email already in use.";
        }
        else{
            if($pass == $cpass){
                $sql = "INSERT INTO `users` ( `user_email`, `user_password`, `timestamp`) VALUES ( '$user_email', '$pass', current_timestamp());";
                $result = mysqli_query($conn,$sql);
                if($result){
                    $showAlert = true;
                    header("Location:/Internship_project/day 11/main.php?signupsuccess=true");
                    exit();
                }
            }
            else{
                $showError = "Password do not match";
            }
        }
        header("Location : /Internship_project/day 11/main.php?signupsuccess=false&error=$showError");
    }

?>