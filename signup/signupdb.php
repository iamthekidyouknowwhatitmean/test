<?php
session_start();
require_once '../connect.php';

$name = $_POST['name'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$confirm_pass = $_POST['confirm_pass'];

if($pass !== $confirm_pass){
    $_SESSION['mess_signup'] = 'Пароли не совпадают';
    header("Location:signup.php");
}else{
    $info = mysqli_query($connect,'SELECT * FROM users');
    $info = mysqli_fetch_all($info);

    $i = 0;
    $fl = false;
    while(($fl === false) && ($i <= count($info))){
        $name_from_data = $info[$i][1];
        $phone_from_data = $info[$i][2];
        $email_from_data = $info[$i][3];

        if(($name === $name_from_data) || 
        ($phone_number === $phone_from_data) || 
        ($email === $email_from_data)){
            $fl = true;
        }
        $i++;
    }
    if($fl === true){
        $_SESSION['mess_signup'] = 'Пользователь c такими данными уже зарегистрирован';
    }else{
        mysqli_query($connect,"INSERT INTO `users` (`id`, `name`, `phone_number`, `mail`, `pass`) VALUES (NULL, '$name', '$phone_number', '$email', '$pass')");
        $_SESSION['mess_signup'] = 'Пользователь успешно зарегистрирован';
    }
    header("Location:signup.php");
}


