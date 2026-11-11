<?php

require "connection.php";

if(isset($_GET["id"])){

    $cid = $_GET["id"];

    Database::iud("DELETE FROM `food` WHERE `id`='".$cid."'");

    echo ("success");

}else{
    echo ("Something went wrong");
}

?>