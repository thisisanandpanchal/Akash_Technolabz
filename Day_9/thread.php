<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>php coding forum</title>
    

</head>

<body>
    <?php
        include 'partials/db_connect.php';
        include 'partials/header.php';
    $id = $_GET['threadid'];
    $sql = " SELECT * FROM `threads` WHERE `threads`.`threads_id`='$id'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['threads_title'];
        $desc = $row['threads_desc'];
        $threads_user_id = $row['threads_user_id'];
        $sql2 = "SELECT `user_email` FROM `users` WHERE `users`.`sno`='$threads_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_email'];
    }

    ?>
     <?php
        $method = $_SERVER['REQUEST_METHOD'];
        $showAlert = false;
        if ($method == 'POST') {
            $comment = $_POST['comment'];
            $comment =str_replace("<","&lt",$comment);
            $comment =str_replace(">","&gt",$comment);
            $sno = $_POST['sno'];

            $sql = "INSERT INTO `comments` ( `comment_content`, `threads_id`, `comment_by`, `comment_time`) VALUES ( '$comment', '$id', '$sno', current_timestamp());";
            $result = mysqli_query($conn, $sql);
            $showAlert = true;
        
        }

    ?>
    
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"> <?php echo $title ?> </h1>
            <p class="lead" style="font-family:bold;"><?php echo $desc ?></p>
            <hr class="my-4">
            <p>This is a peer forum. no span/advertising/self-promote in the forums is not allowed. Do not post
                copyright-infringing material. Do not post "offensive" posts,links or images. Do not cross post
                questions. Remain respectful of other member at all times.</p>
            <p> Posted by : <b><?php echo $posted_by ?></b></p>
        </div>
    </div>
    <?php
    


        echo '
        <div class="container">
        <h1 class=" py-3">Post a Comments</h1>
        <form action="" method="POST">
        
        
        <div class="form-group">
        <label for="exampleFormControl">Type your comment</label>
        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
        <input type="hidden" name="sno" value="">
            </div>
            <div style="margin-top :5px;">
                <button type="submit" class="btn btn-success">Post Comment</button>
            </div>
        </form>
    </div> ';
   
    ?>
    <div class="container my-3" style="min-height: 515px;">
        <h1 py-3>Comments</h1>


        <?php

        $id = $_GET['threadid'];

        $sql = " SELECT * FROM `comments` WHERE `comments`.`threads_id`='$id' ";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $threads_user_id = $row['comment_by'];
            $sql2 = "SELECT `user_email` FROM `users` WHERE `users`.`sno`='$threads_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);



            echo ' <div class="media my-3" style=" display : flex ;">
                        <img src="/Internship_project/day 9/image/user.png" style="height: 30px;" alt="..." class="mr-3">
                        <div class="media-body " style=" margin-left : 10px ;">
                        <p class=" my-0"><b>' . $row2['user_email'] . '</b></p>
                           ' . $content . '
                            </div>
                            </div>';
        }
       

        ?>

    </div>
    
    <?php include 'partials/footer.php' ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
</body>


</html>