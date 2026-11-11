<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){
if(isset($_GET["id"])){
    
    $email = $_SESSION["u"]["email"];
    $fid = $_GET["id"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `food_id`='".$fid."' AND `user_email`='".$email."'");
    $cart_num = $cart_rs->num_rows;

    $food_rs = Database::search("SELECT * FROM `food` WHERE `id`='".$fid."'");
    $food_data = $food_rs->fetch_assoc();
    // $product_qty = $product_data["qty"];

    if($cart_num == 1){

        $cart_data = $cart_rs->fetch_assoc();
        $current_qty = $cart_data["qty"];
        $new_qty = (int)$current_qty + 1;

        if(20 >= $new_qty){

            Database::iud("UPDATE `cart` SET `qty`='".$new_qty."' WHERE `food_id`='".$fid."' AND `user_email`='".$email."'");
            echo ("Order Updated");

        }else{
            echo ("Invalid quantity");
        }

    }else{

        Database::iud("INSERT INTO `cart`(`food_id`,`user_email`,`qty`) VALUES ('".$fid."','".$email."','1')");
        echo ("Order added successfully");

    }

}else{
    echo ("Something went wrong");
}
}else{
    echo ("Please Sign In or Register.");
}
?>