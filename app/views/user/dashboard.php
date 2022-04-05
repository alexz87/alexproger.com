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
                <form action="/user/edit" method="post">
                    <input type="hidden" name="edit_btn">
                    <button type="submit" class="btn" id="edit">Змінити</button>
                </form>
                <form action="/user/dashboard" method="post">
                    <input type="hidden" name="exit_btn">
                    <button type="submit" class="btn" id="back">Вийти</button>
                </form>

                <?php if ($data['user']->login == 'admin' || $data['user']->login == 'nasty'): ?>

                    <form action="/user/dashboard" method="post" class="block-search">
                        <h3>Search:</h3>
                        <input type="search" name="search" class="search"><br>
                        <input type="submit" name="submit" class="btn" value="Search">
                    </form>

                <?php endif; ?>

            </div>
            <div class="users">

            <?php if ($data['user']->login == 'admin' || $data['user']->login == 'nasty'): ?>

                <h2>На сайті зареєстровано: <?=count($data['users'])?> users!</h2>
                <h2>Сайт відвідало: <?=$data['click']?> users!</h2>
                
                <?php for ($i = 0; $i < count($data['search']); $i++): ?>

                    <hr>
                    <h3>Result search:</h3>
                    <h2><?=$data['search'][$i]->email?></h2>
                    <h2>name: <?=$data['search'][$i]->name?>, surname: <?=$data['search'][$i]->surname?></h2>
                    <h2>login: <?=$data['search'][$i]->login?></h2>

                <?php endfor; ?>

            <?php elseif ($data['user']->id == 100): ?>

                <h2>Ви 100-й користувач зареєстрований на цьому сайті</h2>

            <?php elseif ($data['user']->id == 1000): ?>

                <h2>Ви 1000-й користувач зареєстрований на цьому сайті</h2>

            <?php else: ?>

                <h2>Сайт тимчасово знаходиться в розробці!</h2>

            <?php endif; ?>

            </div>
        </div>
        <div class="space"></div>

        <?php require 'public/blocks/footer.php'; ?>

    </body>
</html>
