<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>php coding forum</title>
    <style>
        a {
            text-decoration: none;
        }

      

        #maincontainer {
            min-height: 84vh;
        }

    </style>
</head>

<body>
    <?php
    include 'partials/db_connect.php';
    include 'partials/header.php';


    ?>


    <div class="container my-3" id="maincontainer">

        <h1>Search results for <em> "<?php echo $_GET['search'] ?>"</em></h1>
        <?php
        $noresult = true;
        $query = $_GET['search'];
        $sql = " SELECT * FROM `threads` WHERE MATCH(threads_title,threads_desc) against ('$query')";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['threads_title'];
            $desc = $row['threads_desc'];
            $id = $row['threads_id'];
            $url = "thread.php?threadid=" . $id;
            $noresult= false;
            echo '  <div class="result">
                     <h3><a href="' . $url . '" class="text-dark">' . $title . '</a></h3>
                     <p>' . $desc . '</p>
                 </div>';
        }
        if ($noresult) {
            echo '<div class="jumbotron jumbotron-fluid ">
            <div class="container">
              <h1 class="display-4">No Results Found</h1>
              <p class="lead">Suggestions:<ul>

                        <li> Make sure that all words are spelled correctly.</li>
                        <li> Try different keywords.</li>
                        <li>Try more general keywords.</li></ul>
              
              </p>
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