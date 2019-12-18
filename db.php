<?php

$con = mysqli_connect("localhost",'root','','aqualnbn_cms');


if(!$con){
    echo "not connected to fucking server";

}
if(!mysqli_select_db($con,'e_commerce')){
    echo "database not selected";
}
?>

