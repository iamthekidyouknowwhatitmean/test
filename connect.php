<?php

$connect = mysqli_connect('localhost','root','','dbusers');
if(!$connect){
    die("Connection failed: " . mysqli_connect_error());
}