<?php

session_start();
require "connection.php";

$email = $_SESSION["u"]["email"];

$category = $_POST["ca"];
$title = $_POST["t"];
$cost = $_POST["cost"];
$dckm = $_POST["dckm"];
$desc = $_POST["desc"];

if($category == "0"){
    echo ("Please select a Category");
}else if(empty($title)){
    echo ("Please Enter a Title");
}else if(strlen($title) >= 100){
    echo ("Title should have lover than 100 characters");
}else if(empty($cost)){
    echo ("Please Enter the Price.");
}else if(!is_numeric($cost)){
    echo ("Invalid input for Cost");
}else if(empty($dckm)){
    echo ("Please Enter the delivery fee per KM.");
}else if(!is_numeric($dckm)){
    echo ("Invalid input for delivery cost per KM");
}else if(empty($desc)){
    echo ("Please Enter a Description.");
}else{

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $status = 1;

    Database::iud("INSERT INTO `food`
    (`price`,`description`,`title`,`datetime_added`,`delivery_fee_per_km`,`category_id`,
    `user_email`) VALUES 
    ('".$cost."','".$desc."','".$title."','".$date."','".$dckm."','".$category."',
    '".$email."')");

    echo ("Product saved successfully");

    $food_id = Database::$connection->insert_id;

    $length = sizeof($_FILES);

    if($length <= 3 && $length > 0){

        $allowed_img_extentions = array ("image/jpg","image/jpeg","image/png","image/svg+xml");

        for($x = 0; $x < $length;$x++){
            if(isset($_FILES["image".$x])){

                $img_file = $_FILES["image".$x];
                $file_extention = $img_file["type"];

                if(in_array($file_extention,$allowed_img_extentions)){

                    $new_img_extention;

                    if($file_extention == "image/jpg"){
                        $new_img_extention = ".jpg";
                    }else if($file_extention == "image/jpeg"){
                        $new_img_extention = ".jpeg";
                    }else if($file_extention == "image/png"){
                        $new_img_extention = ".png";
                    }else if($file_extention == "image/svg+xml"){
                        $new_img_extention = ".svg";
                    }

                    $file_name = "resource//images//".$title."_".$x."_".uniqid().$new_img_extention;
                    move_uploaded_file($img_file["tmp_name"],$file_name);

                    Database::iud("INSERT INTO `images`(`code`,`food_id`) VALUES ('".$file_name."','".$food_id."')");

                }else{
                    echo ("Invalid Image type");
                }

            }
        }

        echo ("Product image saved successfully");

    }else{
        echo ("Invalid image count");
    }
    
    
    
}

?>