<?php

require "connection.php";

$email = $_POST["e"];
$np = $_POST["n"];
$rnp = $_POST["r"];
$vcode = $_POST["v"];

if(empty($email)){
    echo("Missing email address");
}else if(empty($np)){
    echo("Please insert a new password");
}else if(strlen($np)<5 || strlen($np)>20){
    echo("Invalid Password");
}else if(empty($rnp)){
    echo("Please Re-type your new password");
}else if(strlen($rnp)<5 || strlen($rnp)>20){
    echo("Re-typed Password Invalid");
}else if($np != $rnp){
    echo("Passwords are not matched");
}else if(empty($vcode)){
    echo("Verification Code is empty");
}else{
    
    $rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' AND 
    `verification_code` = '".$vcode."' ");
    $n = $rs->num_rows;

    if($n == 1){

        Database::iud("UPDATE `user` SET `password`='".$np."' WHERE `email`= '".$email."' ");
        echo("Success");

    }else{
        echo("Invalid Email or Verification Code");
    }
}


?>