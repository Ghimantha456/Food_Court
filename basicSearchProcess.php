<?php

require "connection.php";

$txt = $_POST["t"];
$select = $_POST["s"];

$query = "SELECT * FROM `food`";

if(!empty($txt) && $select == 0){
    $query .= " WHERE `title` LIKE '%".$txt."%'";
}else if(empty($txt) && $select != 0){
    $query .= " WHERE `category_id`='".$select."'";
}else if(!empty($txt) && $select != 0){
    $query .= " WHERE `title` LIKE '%".$txt."%' AND `category_id`='".$select."'";
}

?>

<div class="row">
    <section class="col-12 py-3 border border-dark">
    

        <?php


        if ("0" != ($_POST["page"])) {
            $pageno = $_POST["page"];
        } else {
            $pageno = 1;
        }

        $food_rs = Database::search($query);
        $food_num = $food_rs->num_rows;

        $results_per_page = 10;
        $number_of_pages = ceil($food_num / $results_per_page);

        $page_results = ($pageno - 1) * $results_per_page;
        $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

        $selected_num = $selected_rs->num_rows;

        for ($x = 0; $x < $selected_num; $x++) {
            $selected_data = $selected_rs->fetch_assoc();

        ?>

        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <div class="col mb-5">
                    <div class="card h-100">
                    <!-- Product image-->
                    <?php

                    $selected_img = Database::search("SELECT * FROM `images` WHERE `food_id` = '".$selected_data["id"]."'");
                    $selected_img_data = $selected_img->fetch_assoc();
                    
                    
                    ?>
                        <img class="card-img-top" src="<?php echo $selected_img_data["code"]; ?>" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder"><?php echo $selected_data["title"]; ?></h5>
                                <br/>
                                <!-- Product price-->
                                <div class="fw-bolder"><?php echo $selected_data["price"]; ?> LKR </div>
                            </div>
                        </div>
                        <br/>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-dark mt-auto" href="#">Order Now</a></div>
                            <br/>
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to Cart</a></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php

        }
        ?>
        </div>
    </section>

            

        
    <!--  -->
    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-lg justify-content-center">
                        <li class="page-item">
                            <a class="page-link" <?php if ($pageno <= 1) {
                                                        echo ("#");
                                                    } else {
                                                    ?> onclick="basicSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                    } ?> aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php

                        for ($x = 1; $x <= $number_of_pages; $x++) {
                            if ($x == $pageno) {
                        ?>
                                <li class="page-item active">
                                    <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="page-item">
                                    <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                                </li>
                        <?php
                            }
                        }

                        ?>

                        <li class="page-item">
                            <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                        echo ("#");
                                                    } else {
                                                    ?> onclick="basicSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                    } ?> aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!--  -->
</div>