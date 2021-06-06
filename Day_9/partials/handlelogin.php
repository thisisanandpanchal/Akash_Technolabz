<?php
    $showError = false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'db_connect.php';
        $email = $_POST['loginEmail'];
        $pass = $_POST['loginPass'];

        $sql = "SELECT * FROM `users` WHERE `users`.`user_email`='$email'";
        $result = mysqli_query($conn,$sql);
        $numRows =mysqli_num_rows($result);
        if ($numRows==1) {
            $row = mysqli_fetch_assoc($result);
            if($pass==$row['user_password']){
                   
                    session_start();
                     $_SESSION['loggedin'] = true;
                     $_SESSION['sno'] = $row['sno'];
                     $_SESSION['useremail'] = $email;
                     echo "logged in" . $email;
                     echo $_SESSION['loggedin'];
                     
                     header("Location:/Internship_project/day 9/main.php?loginsuccess=true");
                } 

                
                
                else{
                 header("Location:/Internship_project/day 9/main.php");
                 
             }
        }
        
    }
?>