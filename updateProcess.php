<?php

session_start();
require "connection.php";

if(isset($_SESSION["p"])){

    $pid = $_SESSION["p"]["id"];

    $title = $_POST["t"];
    $dckm = $_POST["dckm"];
    $description = $_POST["d"];

    Database::iud("UPDATE `food` SET `title`='".$title."',
    `delivery_fee_per_km`='".$dckm."',`description`='".$description."' WHERE `id`='".$pid."'");

    echo ("Product has been Updated! ");

    $length = sizeof($_FILES);
    $allowed_img_extentions = array("image/jpg","image/jpeg","image/png","image/svg+xml");

    
    if($length <= 3 && $length > 0){

        Database::iud("DELETE FROM `images` WHERE `product_id`='".$pid."'");

        for($x = 0;$x < $length;$x++){
            if(isset($_FILES["i".$x])){

                $img_file = $_FILES["i".$x];
                $file_type = $img_file["type"];

                if(in_array($file_type,$allowed_img_extentions)){

                    $new_img_extention;

                    if($file_type == "image/jpg"){
                        $new_img_extention = ".jpg";
                    }else if($file_type == "image/jpeg"){
                        $new_img_extention = ".jpeg";
                    }else if($file_type == "image/png"){
                        $new_img_extention = ".png";
                    }else if($file_type == "image/svg+xml"){
                        $new_img_extention = ".svg";
                    }

                    $file_name = "resource//mobile_images//".$title."_".$x."_".uniqid().$new_img_extention;
                    move_uploaded_file($img_file["tmp_name"],$file_name);

                    
                    
                    Database::iud("INSERT INTO `images`(`code`,`food_id`) VALUES ('".$file_name."','".$pid."')");

                    echo (" Image updated");

                }else{
                    echo ("File type not allowed!");
                }

            }
        }


    }else{
        echo ("Invalid Image Count!");
    }

}

?>