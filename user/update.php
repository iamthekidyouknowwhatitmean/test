<?php
session_start();
require_once '../connect.php';

$id = $_POST['id'];
$name = $_POST['name'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$pass = $_POST['pass'];

$info = mysqli_query($connect,'SELECT * FROM users');
$info = mysqli_fetch_all($info);

$fl = false;
$i = 0;
while(($fl === false) && ($i <= count($info))){
    $name_from_data = $info[$i][1];
    $phone_from_data = $info[$i][2];
    $email_from_data = $info[$i][3];

    if(($id !== $info[$i][0]) && (($name === $name_from_data) || 
    ($phone_number === $phone_from_data) || 
    ($email === $email_from_data))){
        $fl = true;
    }
    $i++;
}

if($fl === true){
    $_SESSION['mess_profile'] = 'Пользователь c такими данными уже существует, попробуйте другие';
}else{
    mysqli_query($connect,"UPDATE users SET name = '$name',phone_number='$phone_number',mail='$email',pass='$pass' WHERE `users`.`id` = '$id'");
    $_SESSION['mess_profile'] = 'Данные пользователя успешно обновлены';
}

$_SESSION['id'] = $id;
header("Location:user_profile.php");

