<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body style="text-align:center">
    <form action="signupdb.php" method="post">
        <div>
            <label for="name">Имя</label>
            <input type="text" id="name" name="name" required>
        </div>
        <br>
        <div>
            <label for="phone">Номер телефона</label>
            <input type="tel" id="phone" name="phone_number" required>
        </div>
        <br>
        <div>
            <label for="email">Электронная почта</label>
            <input type="email" id="email" name="email" required>
        </div>
        <br>
        <div>
            <label for="pass">Пароль</label>
            <input type="password" id="pass" name="pass" required>
        </div>
        <br>
        <div>
            <label for="confirm_pass">Подтверждение пароля</label>
            <input type="password" id="confirm_pass" name="confirm_pass" required>
        </div>
        <br>
        <input type="submit" value="Зарегистрироваться">
    </form>
    <br>
    <a href="../index.php">Войти</a>
    <p style="color:red">
        <?php

            if(array_key_exists('mess_signup',$_SESSION)){
                echo $_SESSION['mess_signup'];
                header("Refresh:2");
            }
            unset($_SESSION['mess_signup']);
        ?>
    </p>
</body>
</html>