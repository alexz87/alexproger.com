<!DOCTYPE html>
<html lang="ua">

    <?php require 'public/blocks/head.php'; ?>

    <body>

        <?php require 'public/blocks/header.php'; ?>

        <div class="conteiner">
            <div class="reg">
                <form action="/user/reg" method="post" class="form-control">
                    <h1>Реєстрація користувача:</h1>
                    <input type="email" name="email" placeholder="Введіть email:"  value="<?=$_POST['email']?>"><br>
                    <input type="password" name="pass" placeholder="Введіть пароль:"  value="<?=$_POST['pass']?>"><br>
                    <input type="password" name="re_pass" placeholder="Перевірка пароля:"  value="<?=$_POST['re_pass']?>"><br>
                    <div class="error"><?=$data['message']?></div><br>

                    <?php if ($data['message'] == 'Такий email вже зареєстровано'): ?>
                    
                        <h3 id="auth">Ви можете <a href="/user/auth">авторизуватися</a></h3>
                        
                    <?php endif; ?>

                    <button class="btn mob" id="send">Реєстрація</button>
                </form>
            </div>
        </div>

        <?php require 'public/blocks/footer.php'; ?>

    </body>
</html>