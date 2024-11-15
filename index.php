<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
</head>

<body style="text-align:center">
    <form action="signin/signindb.php" method="post">
        <div>
            <label for="login">Почта/телефон</label>
            <input type="text" id="login" name="login" required>
        </div>
        <br>
        <div>
            <label for="pass">Пароль</label>
            <input type="password" id="pass" name="pass" required>
        </div>
        <br>
        <div id="captcha-container" class="smart-captcha" data-sitekey="ysc1_AKaSkPbCcSGPznDSb3PYazEAUN8iy09rmTF4YmWab6bf3210" style="height:100px">
            <input type="hidden" name="smart-token" value="<токен>">
        </div>
        <br>
        <input type="submit" value="Войти">
    </form>
    <p>Нет аккаунта?<a href="signup/signup.php">Зарегистрироваться</a></p>
    <p style="color:red">
        <?php
            if(array_key_exists('mess_signin',$_SESSION)){
                echo $_SESSION['mess_signin'];
                header('refresh: 2');
            }
            unset($_SESSION['mess_signin']);
        ?>
    </p>
    
</body>
</html>