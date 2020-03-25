<?php
include("../config.php");
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Our Trips</title>
    <style>
        .intro {
            display: none;
        }

        /*https://leaverou.github.io/css3patterns/# */
        body {
            background-color: black;
            background-image:
                radial-gradient(white, rgba(255, 255, 255, .2) 2px, transparent 40px),
                radial-gradient(white, rgba(255, 255, 255, .15) 1px, transparent 30px),
                radial-gradient(white, rgba(255, 255, 255, .1) 2px, transparent 40px),
                radial-gradient(rgba(255, 255, 255, .4), rgba(255, 255, 255, .1) 2px, transparent 30px);
            background-size: 550px 550px, 350px 350px, 250px 250px, 150px 150px;
            background-position: 0 0, 40px 60px, 130px 270px, 70px 100px;
        }

        .carousel {
            position: relative;
        }
    </style>
    <?php
    include_once("../php_common/nav.php");
    main_CSSandIcon("1", "1");
    ?>
</head>

<body class="bg-secondary">
    <?php
    include_once("../php_common/nav.php");
    navbar("1");
    preloader();

    ?>
    <div id="carouselId" class="carousel slide col-lg-6 mx-auto " data-ride="carousel">
        <div class="carousel-inner" role="listbox" id="carousel-inner">
        </div>
        <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <form class="input-group my-3 p-3 input-group-lg col-lg-10 mx-auto" method="POST" action="">
        <div class="input-group-prepend">
            <span class="input-group-text" id="addOnText">Tour Code</span>
        </div>
        <input type="text" class="form-control" placeholder="Type specific Tour Code" required name="TourCode" id="TourCodeInput">
        <!--<input type="text" class="form-control" placeholder="Type specific Tour Code" required name="TourName" id="TourNameInput">-->
        <div class="input-group-append">
            <input class="btn btn-light border" type="submit" id="button-addon2" value="Search">
        </div>
    </form>

    <div class="jumbotron col-lg-10 mx-auto">
        <div class="row">
            <?php
            include_once("../php_common/nav.php");
            include_once("../config.php");
            $Tour_Code = mysqli_real_escape_string($db, $_POST['TourCode']);
            $Tour_Name = mysqli_real_escape_string($db, $_POST['TourName']);
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if ($Tour_Code !== null) {
                    trip_info($Tour_Code);
                } else {
                    CallAllTour();
                }
            } else {
                CallAllTour();
            }
            ?>
        </div>
    </div>


    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
<script src="app.js"></script>

</html>