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

        body {
            background-color: rgba(18, 140, 221, 0.5);
        }
    </style>
</head>

<body>
    <?php
    include 'partials/db_connect.php';
    include 'partials/header.php';
    include 'partials/handlesignup.php';
    include 'partials/handlelogin.php';

    ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/Internship_project/day 8/image/coding_1.jpg" style="height: 300px;" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/Internship_project/day 8/image/coding_2.jpg" style="height: 300px;" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/Internship_project/day 8/image/coding_3.jpg" style="height: 300px;" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container my-3">
        <h2 class="text-center">iDiscuss-Browse categories</h2>
        <div class="row">

            <?php 
            $sql = " SELECT * FROM `categories`";
            $result = mysqli_query($conn,$sql);
            while ($row = mysqli_fetch_assoc($result)) {
                
              $id = $row['category_id'];
              $cat = $row['category_name'];
              $desc = $row['category_description'];
                echo '  
                <div class="col-md-4 my-2">
                <div class="card " style="width: 18rem;">
                                <img src="/Internship_project/day 8/image/'.$cat.'.jpg"   style="height:200px;"  class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="threadlist.php?catid='.$id.'">'.$cat.'</a></h5>
                                    
                                    <p class="card-text">'.substr($desc,0,50).'..... </p>
                                    <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">View Threads</a>
                                </div>
                               
                            </div>
                        </div>
                        ';
                    }
                    
                    ?>
        </div>


    </div>


    


   
    <?php include 'partials/footer.php' ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>



</body>

</html>