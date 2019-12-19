<?php
    require "connectdb.php";
    include "catering.php";
    session_start();
    if(!isset($_SESSION['IDLOGINCAT'])){
        ?>
        <script language ="javascript">
            alert("Maaf Login terlebih dahulu");
            document.location="login.html";
        </script>
        <?php
    } else {
        $IDLOGINCAT = $_SESSION['IDLOGINCAT'];
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Catering</title>
    <!-- FRAMEWORK BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

</head>

<body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg mb-5">
            <a class="navbar-brand" href="#">Catery</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="addFood_view.php">ADD FOOD <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="logout.php">Logout</a>                           
                        </div>
                    </li>
                    <li class="nav-item">
                        <?php
                            $IDLOGINCAT = $_SESSION["IDLOGINCAT"];

                            $welcome = "SELECT * FROM catering where kd_Catering = '$IDLOGINCAT'";
                            $result = mysqli_query($connnectdb, $welcome);
                            $row = mysqli_fetch_array($result);
                        ?>
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Welcome <?= $row['catering_Name'];?></a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>

    <?php 
    $sqlfood = "SELECT food.kd_Food, food.food_Name, food.food_Description, food.food_Image, food.food_Price, catering.catering_Name from food INNER JOIN catering ON catering.kd_Catering = food.kd_Catering WHERE catering.kd_Catering = '$IDLOGINCAT'";
    $resultfood = mysqli_query($connnectdb, $sqlfood);
    while($rowfood = mysqli_fetch_array($resultfood)){ ?>
    <div class="container">
        <div class="card" style="width: 18rem;">
            <img src="<?= $rowfood['food_Image']?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?=$rowfood['food_Name']?></h5>
                <p class="card-text"><?=$rowfood['catering_Name']?> </p>
                <p class="card-text"><?=$rowfood['food_Description']?> </p>
                <p class="card-text">Rp.<?=$rowfood['food_Price']?> </p>
                <a href="editFood_view.php?id=<?= $rowfood['kd_Food']?>" class="btn btn-primary btn-block">Edit</a>
            </div>
        </div>    
    </div>
    <?php } ?>
</body>

</html>