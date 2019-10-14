<?php
include("../config.php");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-secondary">
    <?php
    include_once("../php_common/nav.php");
    navbar();
    ?>

    <form class="input-group my-3 p-3 input-group-lg col-lg-10 mx-auto" method="POST" action="">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Tour Code</span>
        </div>
        <input type="text" class="form-control" placeholder="Type specific Tour Code">
        <div class="input-group-append">
            <input class="btn btn-light border" type="submit" id="button-addon2" value="Button">
        </div>
    </form>
    
    <div class="jumbotron col-lg-10 mx-auto">
        <h1 class="text-center mb-3">Most Popular Trips!</h1>

        <div class="row">
            <?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include_once("../php_common/nav.php");
    include_once("../config.php");
    $Tour_Code = mysqli_real_escape_string($db,$_POST['search_text']);
    
    trip_info($Tour_Code);
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

</html>