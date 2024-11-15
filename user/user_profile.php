<?php
    session_start();
    require_once '../connect.php';
    $id = $_SESSION['id'];

    $info = mysqli_query($connect,"SELECT * FROM users WHERE id = '$id'");
    $info = mysqli_fetch_assoc($info);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
</head>
<body>
    <a href="../index.php">Выйти</a>
    <div style="text-align:center">
        <form action="update.php" method="post">
                <input type="hidden" name="id" value="<?=$id?>">
                <div>
                    <label for="name">Имя</label>
                    <input type="text" id="name" name="name" value= "<?=$info['name']?>" required>
                </div>
                <br>
                <div>
                    <label for="phone">Номер телефона</label>
                    <input type="tel" id="phone" name="phone_number" value= "<?=$info['phone_number']?>" required>
                </div>
                <br>
                <div>
                    <label for="email">Электронная почта</label>
                    <input type="email" id="email" name="email" value= "<?=$info['mail']?>" required>
                </div>
                <br>
                <div>
                    <label for="pass">Пароль</label>
                    <input type="password" id="pass" name="pass" value= "<?=$info['pass']?>" required>
                </div>
                <br>
                <input type="submit" value="Изменить">
        </form>
        <p style="color:red">
            <?php
                if(array_key_exists('mess_profile',$_SESSION)){
                    echo $_SESSION['mess_profile'];
                    header("Refresh:2");
                }
                unset($_SESSION['mess_profile']);
            ?>
        </p>
    </div>
    
</body>
</html>