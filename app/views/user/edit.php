<?php

    if ($_COOKIE['login'] == '') {
        header('Location: /user/auth');
        exit();
    }

?>

<!DOCTYPE html>
<html lang="ua">

    <?php require 'public/blocks/head.php'; ?>

    <body>

        <?php require 'public/blocks/header.php'; ?>

        <div class="conteiner">
            <div class="user-info">
                
                <?php if ($data['user']->name == 'none'): ?>

                    <h1>Привіт, <?=$data['user']->email?></h1><br>

                <?php else: ?>

                    <h1>Привіт, <?=$data['user']->name?></h1><br>

                <?php endif; ?>

                <div class="photo">
                    <img id="photo" src="/public/photos/<?=$data['user']->photo?>">
                </div>
                <form class="upload" action="/user/edit" enctype="multipart/form-data" method="post">
                    <p>Завантажте ваше фото:</p>
                    <input type="file" name="uploadPhoto" id="uploadPhoto">
                    <button type="submit" class="btn" name="submit">Завантажити</button>
                </form>
                <form action="/user/dashboard" method="post">
                    <input type="hidden" name="redit_btn">
                    <button type="submit" class="btn" id="redit">Готово</button>
                </form>

                <?php
                    $target_dir = 'public/photos/';
                    $target_file = $target_dir . basename($_FILES["uploadPhoto"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    if (isset($_POST["submit"])) {
                        $check = getimagesize($_FILES["uploadPhoto"]["tmp_name"]);
                        if ($check !== false) {
                            $uploadOk = 1;
                        } else {
                            echo "Це не фото";
                            $uploadOk = 0;
                        }
                    }

                    if ($uploadOk == 0) {
                        echo "Фото не завантажено";
                    } else {
                        if (move_uploaded_file($_FILES["uploadPhoto"]["tmp_name"], $target_file)) {
                            echo "Фото завантажено";
                            rename(
                                "public/photos/" . htmlspecialchars( basename( $_FILES["uploadPhoto"]["name"])),
                                "public/photos/IMG_" . $data['user']->id . ".jpg"
                            );
                        }
                    }
                ?>

            </div>
            <div class="redit-info">
                <form action="/user/edit" method="post" class="form-control">
                    <h2>Редагування інформації:</h2>
                    <input type="name" name="name" placeholder="Введіть ім'я:"><br>
                    <input type="surname" name="surname" placeholder="Введіть прізвище:"><br>
                    <input type="login" name="login" placeholder="Введіть логін:"><br>
                    <input type="email" name="email" placeholder="Введіть email:"><br>
                    <div class="error"><?=$data['message_data']?></div><br>
                    <button class="btn mob" id="edit_data">Змінити</button>
                </form>
                <form action="/user/edit" method="post" class="form-control">
                    <h2>Змінити пароль:</h2>
                    <input type="password" name="pass" placeholder="Введіть старий пароль:"><br>
                    <input type="password" name="new_pass" placeholder="Введіть новий пароль:"><br>
                    <input type="password" name="re_new_pass" placeholder="Повторіть новий пароль:"><br>
                    <div class="error"><?=$data['message_pass']?></div><br>
                    <button class="btn mob" id="edit_pass">Змінити</button>
                </form>
            </div>
        </div>
        <div class="space"></div>

        <?php require 'public/blocks/footer.php'; ?>

    </body>

</html>
