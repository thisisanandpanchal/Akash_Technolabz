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