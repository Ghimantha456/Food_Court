<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container px-4 row-cols-auto">
    <?php
                
    session_start();

    if (isset($_SESSION["u"])) {
        $data = $_SESSION["u"];
    

    ?>

        <label class="navbar-brand">Welcome <u class="fs-5"><?php echo $data["fname"];?></u> </label>
        <span class="text-lg fw-bold signout" onclick="signout();">| Sign Out |</span>
    
    <?php

    }else{
        ?>

        <a href="index.php" class="navbar-brand fw-bold">Sign In or Register</a>

        <?php
    }

    ?>
    

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="home.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="userProfile.php">User Profile</a></li>
                    <li><a class="dropdown-item" href="purchasingHistory.php">Order History</a></li>
                    <li><a class="dropdown-item" href="myProducts.php">My Products</a></li>
                </ul>
            </li>
        </ul>
        <form class="d-flex">
            <a class="btn btn-outline-dark" href="cart.php">
                <i class="bi-cart-fill me-1">
                Cart
                <?php 

                if (isset($_SESSION["u"])){
                
                    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $data["email"] . "'");
                    $cart_num = $cart_rs->num_rows;
                ?>
                    <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo $cart_num; ?></span>
                <?php 
                }
                ?>
                </i>
            </a>
        </form>
    </div>
</div>
</nav>

    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
</body>

</html>
        