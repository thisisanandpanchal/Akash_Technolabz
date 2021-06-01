<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>php forum</title>
    <style>
        a:link {
            text-decoration: none;
        }

        a:active {
            text-decoration: underline;
        }
    </style>

</head>

<body>
    <?php
    include 'partials/db_connect.php';
    include 'partials/header.php';


    $id = $_GET['catid'];
    $sql = " SELECT * FROM `categories` WHERE `categories`.`category_id`='$id'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catename = $row['category_name'];
        $catedesc = $row['category_description'];
    }
    ?>
     <?php
    $method = $_SERVER['REQUEST_METHOD'];
    $showAlert = false;
    if ($method == 'POST') {
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];

        $th_title  =str_replace("<","&lt",$th_title);
        $th_title  =str_replace(">","&gt",$th_title);

        $th_desc  =str_replace("<","&lt",$th_desc);
        $th_desc  =str_replace(">","&gt",$th_desc);
        $sno = $_POST['sno'];
        $sql = "INSERT INTO `threads` ( `threads_title`, `threads_desc`, `threads_cat_id`, `threads_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno' , current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> Your thread has been added.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
       
    }

    ?>


    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catename ?> forums</h1>
            <p class="lead" style="font-family:bold;"><?php echo $catedesc ?></p>
            <hr class="my-4">
            <p>This is a peer forum. no span/advertising/self-promote in the forums is not allowed. Do not post
                copyright-infringing material. Do not post "offensive" posts,links or images. Do not cross post
                questions. Remain respectful of other member at all times.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>

    <div class="container my-3" style="min-height: 461px;">
        <?php
      
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                
                
                
                echo '
                <div class="container">
                <h1 class=" py-3">Start a Discussions</h1>
                <form action="" ' . $_SERVER["REQUEST_URI"] . ' method="POST">
                <div class="form-group">
                <label for="exampleInputEmail1">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp"
                placeholder="Enter Problem Title">
                <small id="emailHelp" class="form-text text-muted">Keep your title as short as possible.</small>
                </div>
                <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '">
                <div class="form-group">
                <label for="exampleFormControl">Ellaborate Your Concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                </div>
                <div style="margin-top :5px;">
                <button type="submit" class="btn btn-success">Submit</button>
                </div>
                </form>
                </div> ';
                }
            else {

                echo '  <div class="container">
                        <h1 class="py-3">Start a Discussions</h1>
                        <p class="lead">You are not logged in. please login to be able to start a Discussion</p>
                        </div>';
                }
        ?>
         <h1 py-3>Discussions</h1>


        <?php



        $id = $_GET['catid'];
        $sql = " SELECT * FROM `threads` WHERE `threads`.`threads_cat_id`='$id' ";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['threads_id'];
            $title = $row['threads_title'];
            $desc = $row['threads_desc'];
            $threads_user_id = $row['threads_user_id'];
            $sql2 = "SELECT `user_email` FROM `users` WHERE `users`.`sno`='$threads_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);




        echo ' <div class="media my-3">
                    <img src="/Internship_project/day 7/image/user.png" style="height: 30px;" alt="..." class="mr-3">
                    <div class="media-body">' .

                    '<h5 class="mt-0"><a class="text-dark" href="thread.php?threadid=' . $id . '">' . $title . '</a></h5>
                    ' . $desc . ' </div>' . '<p class=" my-0"><b> Asked by : ' . $row2['user_email'] . '</b></p>' .
                    '</div>';
                }
        if ($noResult) {
            echo '  <div class="jumbotron jumbotron-fluid">
            <div class="container">
            <h1 class="display-4">No Threads Found</h1>
            <p class="lead">be the first person to ask the question</p>
            </div>
            </div>';
        }
                
            ?>

            


    </div>
    <?php include 'partials/footer.php' ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
</body>

</html>