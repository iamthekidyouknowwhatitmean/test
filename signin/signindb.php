<?php
session_start();
require_once '../connect.php';

function check_captcha($token) {
    $ch = curl_init("https://smartcaptcha.yandexcloud.net/validate");
    $args = [
        "secret" => "ysc2_AKaSkPbCcSGPznDSb3PYXsgB8TiLBWmN1fpl5W3df4160105",
        "token" => $token,
        "ip" => "localhost", 
                    
    ];
    curl_setopt($ch, CURLOPT_TIMEOUT, 1);
    curl_setopt($ch, CURLOPT_POST, true);    
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($args));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch); 
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpcode !== 200) {
        echo "Allow access due to an error: code=$httpcode; message=$server_output\n";
        return true;
    }
 
    $resp = json_decode($server_output);
    return $resp->status === "ok";
}

$token = $_POST['smart-token']; 
$result = check_captcha($token);

if(strlen($token) === 0){
    $_SESSION['mess_signin'] = "Пожалуйста, пройдите проверку на робота";
    header("Location:../index.php");
}

elseif((strlen($token) !== 0) && ($result===false)) {
    $_SESSION['mess_signin'] = "Отказано в доступе";
    header("Location:../index.php");
}

if((strlen($token) !== 0) && ($result === true)){
    $login = $_POST['login'];
    $pass = $_POST['pass'];

    $info = mysqli_query($connect,'SELECT * FROM users');
    $info = mysqli_fetch_all($info);

    $i = 0;
    $fl = false;
    while(($fl === false) && ($i <= count($info))){
        $phone_from_data = $info[$i][2];
        $email_from_data = $info[$i][3];
        $pass_from_data = $info[$i][4];

        if((($phone_from_data === $login) || ($email_from_data===$login)) && ($pass_from_data===$pass)){
            $fl = true;
        }
        $i++;
    }

    if($fl === true){
        $_SESSION['id'] = $info[--$i][0];
        header("Location:../user/user_profile.php");
    }else{
        $_SESSION['mess_signin'] = "Такого пользователя не существует";
        header("Location:../index.php");
    }
}

?>