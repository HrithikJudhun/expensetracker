<?php

$dbhost = "fdb31.runhosting.com";
$dbuser = "4015650_tracker";
$dbpass = "";
$dbname = "4015650_tracker";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("Connection Failed!");
}
?>