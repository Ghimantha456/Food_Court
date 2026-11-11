<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Home | Food Court</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="resource/logo.png" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php require "connection.php";
    include "header.php";
    ?>

    <div class="col-12 justify-content-center">
        <div class="row mb-2 mt-2">

            <div class="offset-4 offset-lg-1 col-4 col-lg-1 logo" style="height: 60px;"></div>

            <div class="col-12 col-lg-9">

                <div class="input-group mt-3 mb-3">
                    <input type="text" class="form-control rounded-1" aria-label="Text input with dropdown button" id="basic_search_txt">

                    <div class="col-0">
                        <button class="btn btn-outline-secondary bi bi-search" onclick="basicSearch(0);"></button>
                    </div>
                    <select class="form-select ms-5" style="max-width: 200px;" id="basic_search_select">
                        <option value="0">All Categories</option>
                        <?php

                        $category_rs = Database::search("SELECT * FROM `category`");
                        $category_num = $category_rs->num_rows;

                        for($x = 0;$x < $category_num;$x++){
                            $category_data = $category_rs->fetch_assoc();
                        ?>

                            <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>

                        <?php
                        }


                        ?>
                    </select>

                </div>

            </div>


        </div>
    </div>

    <div class="col-12" id="basicSearchResult">
        <div class="row">

            <!-- Header-->
            <header class="bg-secondary py-5">
                <div class="container px-4 px-lg-5 my-5">
                    <div class="text-center text-white">
                        <h1 class="display-4 fw-bolder">Best quality and fresh</h1>
                        <p class="lead fw-normal text-white mb-0">Freshly prepared and dilivered to your doorstep within a moments notice</p>
                    </div>
                </div>
            </header>
            <!-- Header -->

            <?php

            $c_rs = Database::search("SELECT * FROM `category`");
            $c_num = $c_rs->num_rows;

            for($y = 0;$y < $c_num;$y++){
                $cdata = $c_rs->fetch_assoc();

            ?>


            <!-- category name -->

            <div class="col-12 mt-3 mb-2 m-1">
                <a href="#" class="text-decoration-none link-dark fs-3 fw-bold"><?php echo $cdata["name"];?></a> &nbsp;&nbsp;
                <a href="#" class="text-decoration-none link-dark fs-6">See All &nbsp; &rarr;</a>
            </div>

            <!-- category name -->


            <!-- Section-->
            <section class="col-12 py-3 border border-dark">

                <?php

                $food_rs = Database::search("SELECT * From `food` WHERE `category_id`='".$cdata["id"]."' 
                ORDER BY `datetime_added` ASC LIMIT 4 OFFSET 0");
                $food_num = $food_rs->num_rows;

                for($z = 0;$z < $food_num;$z++){
                    $food_data = $food_rs->fetch_assoc();
                ?>
                <div class="container px-4 px-lg-5">
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Product image-->
                                <?php

                                $image_rs = Database::search("SELECT * FROM `images` WHERE `food_id`='".$food_data["id"]."'");
                                $image_data = $image_rs->fetch_assoc();

                                ?>
                                <img class="card-img-top" src="<?php echo $image_data["code"]; ?>" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?php echo $food_data["title"]; ?></h5>
                                        <br/>
                                        <!-- Product price-->
                                        <div class="fw-bolder"><?php echo $food_data["price"]; ?> LKR </div>
                                </div>
                                <br/>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-dark mt-auto" href='<?php echo "singleProductView.php?id=" . $food_data["id"]; ?>'>Order Now</a></div>
                                    <br/>
                                    <div class="text-center"><button class="btn btn-outline-dark mt-auto" onclick="addToCart(<?php echo $food_data['id']; ?>);">Add to Cart</button></div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>

                <?php
                            
                }


                ?>
            </section>
            <!-- Section-->

            <?php

            }

            ?>

        </div>
    </div>

    <?php include "footer.php"; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>
</html>
