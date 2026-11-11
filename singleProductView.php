<?php

require "connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $food_rs = Database::search("SELECT food.id,food.price,food.description,food.title,
    food.datetime_added,food.delivery_fee_per_km,food.category_id FROM `food` WHERE food.id='" . $pid . "'");

    $food_num = $food_rs->num_rows;

    if ($food_num == 1) {

        $food_data = $food_rs->fetch_assoc();

?>


        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title><?php echo $food_data["title"]; ?> | eShop</title>

            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
            <link rel="stylesheet" href="style.css" />

            <link rel="icon" href="resource/logo.png" />
        </head>

        <body>

            <div class="container-fluid">
                <div class="row">

                    <?php include "header.php"; ?>

                    <div class="col-12 mt-0 bg-white singleProduct">
                        <div class="row">
                            <div class="col-12" style="padding: 10px;">
                                <div class="row">

                                    <div class="col-12 col-lg-2 order-2 order-lg-1">
                                        <ul>

                                            <?php

                                            $image_rs = Database::search("SELECT * FROM `images` WHERE `food_id`='" . $pid . "'");
                                            $image_num = $image_rs->num_rows;
                                            $img = array();

                                            if ($image_num != 0) {

                                                for ($x = 0; $x < $image_num; $x++) {
                                                    $image_data = $image_rs->fetch_assoc();
                                                    $img[$x] = $image_data["code"];
                                            ?>

                                                    <li class="d-flex flex-column justify-content-center align-items-center border border-1 
                                                        border-secondary mb-1">
                                                        <img src="<?php echo $img["$x"]; ?>" style="height: 120px;" class="img-thumbnail mt-1 mb-1" 
                                                        id="foodImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>);"/>
                                                    </li>

                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                    <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                    <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                    <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                            <?php
                                            }

                                            ?>

                                        </ul>
                                    </div>

                                    <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                        <div class="row">
                                            <div class="col-12 align-items-center border border-1 border-secondary">
                                                <div class="main-img" id="main_img"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 order-3">
                                        <div class="row">
                                            <div class="col-12">

                                                <div class="row border-bottom border-dark">
                                                    <nav aria-label="breadcrumb">
                                                        <ol class="breadcrumb">
                                                            <li class="breadcrumb-item"><a href="home.php" class="link-dark">Home</a></li>
                                                            <li class="breadcrumb-item active" aria-current="page"><?php echo $food_data["title"]; ?></li>
                                                        </ol>
                                                    </nav>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-4 text-success fw-bold"><?php echo $food_data["title"]; ?></span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="badge">
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-half text-warning fs-5"></i>

                                                            &nbsp;&nbsp;

                                                            <label class="fs-5 text-dark fw-bold">4.5 Stars | 39 Reviews & Ratings</label>
                                                        </span>
                                                    </div>
                                                </div>

                                                <?php
                                                
                                                $price = $food_data["price"];
                                                // $price_full = $food_data["price_full"];
                                                
                                                ?>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-4 fw-bold text-dark"><?php echo $price; ?> LKR</span>
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        <span class="fs-4 fw-bold text-dark">No Special offers</span>
                                                    </div>
                                                </div>

                                                <!-- <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-5 text-primary"><b>Warrenty : </b>6 Months Warrenty</span><br />
                                                        <span class="fs-5 text-primary"><b>Return Policy : </b>1 Months Return Policy</span><br />
                                                    </div>
                                                </div> -->

                                                <!-- <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <div class="row g-2">
                                                            <?php
                                                            // $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                                            // $user_data = $user_rs->fetch_assoc();
                                                            ?>
                                                                <div class="col-12 col-lg-6 border border-1 border-dark text-center">
                                                                    <span class="fs-5 text-primary"><?php echo $user_data["fname"]." ".$user_data["lname"]; ?></span>
                                                                </div>
                                                                <div class="col-12 col-lg-6 border border-1 border-dark text-center">
                                                                    <span class="fs-5 text-primary"><b>Sold : </b>10 Items</span>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div> -->

                                                <!-- <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="my-2 offset-lg-2 col-12 col-lg-8 border border-1 border-danger rounded">
                                                                <div class="row">
                                                                    <div class="col-3 col-lg-2 border-end border-2 border-danger">
                                                                        <img src="resource/pricetag.png" />
                                                                    </div>
                                                                    <div class="col-9 col-lg-10">
                                                                        <span class="fs-5 text-danger fw-bold">
                                                                            Stand a chance to get 5% discount by using VISA or MASTER
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 my-2">
                                                                <div class="row g-2">

                                                                    <div class="border border-1 border-secondary rounded overflow-hidden float-left mt-1 position-relative product-qty">
                                                                        <div class="col-12">
                                                                            <span>Quantity : </span>
                                                                            <input type="text" class="border-0 fs-5 fw-bold text-start" style="outline: none;" 
                                                                            pattern="[0-9]" value="1" id="qty_input" onkeyup='checkValue();'/>

                                                                            <div class="position-absolute qty-buttons">
                                                                                <div class="justify-content-center d-flex flex-column align-items-center border border-1 border-secondary qty-inc">
                                                                                    <i class="bi bi-caret-up-fill text-primary fs-5" onclick='qty_inc();'></i>
                                                                                </div>
                                                                                <div class="justify-content-center d-flex flex-column align-items-center border border-1 border-secondary qty-dec">
                                                                                    <i class="bi bi-caret-down-fill text-primary fs-5" onclick="qty_dec();"></i>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-12 mt-3">
                                                                            <div class="row">
                                                                                <div class="col-4 d-grid">
                                                                                    <button class="btn btn-dark" type="submit" id="payhere-payment" onclick="payNow(<?php echo $pid; ?>);">Order Now</button>
                                                                                </div>
                                                                                <div class="col-4 d-grid">
                                                                                    <button class="btn btn-outline-secondary">Add To Cart</button>
                                                                                </div>
                                                                                <!-- <div class="col-4 d-grid">
                                                                                    <button class="btn btn-secondary">
                                                                                        <i class="bi bi-heart-fill fs-4 text-danger"></i>
                                                                                    </button>
                                                                                </div> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- <div class="col-12 bg-white">
                                <div class="row me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Related Items</span>
                                    </div>
                                </div>
                            </div> -->

                            <!-- <div class="col-12 bg-white">
                                <div class="row g-2">
                                    <div class="offset-1 offset-lg-0 col-4 col-lg-2 text-center">
                                        <div class="card" style="width: 18rem;">
                                        <?php
                                        // $picture_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "'");
                                        // $picture_num = $picture_rs->num_rows;
                                        // $picture = array();

                                        // if ($picture_num != 0) {

                                        //     for ($x = 0; $x < $picture_num; $x++) {
                                        //         $picture_data = $picture_rs->fetch_assoc();
                                        //         $picture[$x] = $picture_data["code"];
                                        ?>
                                            <img src="<?php echo $picture["$x"]; ?>" class="card-img-top" />
                                        <?php
                                        //     }
                                        // }
                                        ?>
                                            <div class="card-body">
                                            <h5 class="card-title"><?php echo $product_data["title"]; ?></h5>
                                            <span class="badge bg-info">New</span> <br/>
                                            <span class="card-text text-primary">Rs. <?php echo $product_data["price"]; ?> .00</span> <br/>
                                            
                                            <?php
                                            
                                            // if($product_data["qty"] > 0){
                                                
                                                ?>

                                                <span class="card-text text-warning fw-bold">In Stock</span> <br/>
                                                <span class="card-text text-success fw-bold"><?php echo $product_data["qty"]; ?> Items Available</span><br/><br/>
                                                <a href='<?php echo "singleProductView.php?id=" . $product_data["id"]; ?>' class="col-12 btn btn-success">Buy Now</a>
                                                <button class="col-12 btn btn-danger mt-2">Add to Cart</button>
                                                
                                                <?php

                                            // }else{

                                                ?>

                                                <span class="card-text text-danger fw-bold">Out of Stock</span> <br/>
                                                <span class="card-text text-danger fw-bold">-</span><br/><br/>
                                                <button class="col-12 btn btn-success disabled">Buy Now</button>
                                                <button class="col-12 btn btn-danger mt-2">Add to Cart</button>
                                                
                                                <?php

                                            // }
                                            
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <div class="col-12 bg-white">
                                <div class="row me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Extra Details</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row">

                                    <!-- <div class="col-6">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label fs-4 fw-bold">Brand : </label>
                                            </div>
                                            <div class="col-9">
                                                <label class="form-label fs-4"><?php echo $product_data["bname"]; ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label fs-4 fw-bold">Model : </label>
                                            </div>
                                            <div class="col-9">
                                                <label class="form-label fs-4"><?php echo $product_data["mname"]; ?></label>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fs-4 fw-bold">Description : </label>
                                            </div>
                                            <div>
                                                <textarea cols="60" rows="10" class="form-control" readonly><?php echo $food_data["description"]; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <?php
                                        $feedback_rs = Database::search("SELECT * From `feedback` WHERE `food_id`='".$food_data["id"]."' ");
                                        $feedback_num = $feedback_rs->num_rows;

                                        for($z = 0;$z < $feedback_num;$z++){
                                            $feedback_data = $feedback_rs->fetch_assoc();
                                        ?>
                                            <div class="row border border-1 border-dark rounded me-0 overflow-scroll" style="height: 300px;">
                                                <div class="col-12 mt-1 mb-1 mx-1">
                                                    <div class="row border border-1 border-dark rounded me-0">
                                                        <div class="col-10 mt-1 mb-1 ms-0">
                                                            <?php 
                                                            $name_rs = Database::search("SELECT * From `user` WHERE `email`='".$feedback_data["user_email"]."' ");
                                                            $name_data = $name_rs->fetch_assoc();
                                                            ?>
                                                            <span class="fw-bold"><?php echo $name_data["fname"]; ?> <?php echo $name_data["lname"]; ?></span>
                                                        </div>
                                                        <?php
                                                        if($feedback_data["type"] == 1){
                                                        ?>
                                                            <div class="col-2 mt-1 mb-1 me-0">
                                                                <span class="badge bg-success">Positive</span>
                                                            </div>
                                                        <?php
                                                        }else if($feedback_data["type"] == 2){
                                                        ?>
                                                            <div class="col-2 mt-1 mb-1 me-0">
                                                                <span class="badge bg-warning">Neutral</span>
                                                            </div>
                                                        <?php
                                                        }else if($feedback_data["type"] == 3){
                                                        ?>
                                                            <div class="col-2 mt-1 mb-1 me-0">
                                                                <span class="badge bg-danger">Negative</span>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    
                                                        <div class="col-12"><hr/></div>
                                                        <div class="col-12">
                                                            <p class="text-center fw-bold text-black-50"><?php echo $feedback_data["feedback"]; ?></p>
                                                        </div>
                                                        <div class="offset-6 col-6 text-end">
                                                            <label class="form-label fs-6"><?php echo $feedback_data["date"]; ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <?php include "footer.php"; ?>

                </div>
            </div>

            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        </body>

        </html>

<?php

    } else {
        echo ("Sorry for the Inconvenience");
    }
} else {
    echo ("Something went wrong");
}

?>