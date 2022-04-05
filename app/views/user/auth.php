<!DOCTYPE html>
<html lang="ua">

    <?php require 'public/blocks/head.php'; ?>

    <body>

        <?php require 'public/blocks/header.php'; ?>

        <div class="conteiner">
            <div class="auth">
                <form action="/user/auth" method="post" class="form-control">
                    <h1>Авторизація користувача:</h1>
                    <input type="email" name="email" placeholder="Введіть email:" value="<?=$data['email']?>"><br>
                    <input type="password" name="pass" placeholder="Введіть пароль:" value="<?=$data['pass']?>"><br>
                    <div class="error"><?=$data['message']?></div><br>
                    <button class="btn" id="load">Увійти</button><br>
                    <h3 id="reg">Ви можете <a href="/user/reg">зареєструватися</a></h3>
                </form>
                
            </div>
        </div>

        <?php require 'public/blocks/footer.php'; ?>

    </body>
</html>