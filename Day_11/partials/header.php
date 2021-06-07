<?php
 session_start();
    echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="main.php">iDiscuss</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="main.php">Home</a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                       Top Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                    $sql = " SELECT `category_id`,`category_name` FROM `categories` LIMIT 3";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                    
                        echo '<a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'. $row['category_name'].'</a>';
                    }                


            
                  echo ' </ul>
                </li>
               
            </ul>

            <div class="row mx-2">';
          if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
              
              echo '<form class="d-flex" method= "get" action= "search.php" >
              <input class="form-control me-2" name= "search" type= "search" placeholder="Search" aria-label="Search">
              <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
              <p class="text-light my-0 mx-2" style="text-align:center">Welcome '.$_SESSION['useremail']. '</p>
              
              <a role="button" href="partials/logout.php" class="btn btn-outline-success " >Logout</a>
              </form>';
            }
            else{
                    echo'  <form class="d-flex" method= "get" action= "search.php">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                    
                    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                    <button class="btn btn-outline-success mx-2 "type="button"  data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-primary">Login</button>
                <button class="btn btn-outline-success" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button> </form>';
        
            }
            
          echo' 
           </div>
        </div>
    </div>
</nav>';
include 'partials/login_modal.php';
include 'partials/signup_modal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']== true){
    echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert" >
    <strong>Success!</strong>Now you can Signup please Login to iDiscuss.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

}
if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']== true){
    echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert" >
    <strong>Success!</strong> Now you can Login.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

}
if(isset($_GET['logoutsuccess']) && $_GET['logoutsuccess']== true){
    echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert" >
    <strong>Success!</strong> Now you can Logout.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

}

 
?>
