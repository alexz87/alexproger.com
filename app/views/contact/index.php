<!DOCTYPE html>
<html lang="ua">

    <?php require 'public/blocks/head.php'; ?>

    <body>

        <?php require 'public/blocks/header.php'; ?>

        <div class="conteiner">
            <div class="before-contact">
                <div class="contact">
                    <p>Олександр Задорожній</p>
                    <p>Мій телефон: <a class="tel:+380939947369">+38 (093) 994 - 73 - 69</a></p>
                    <p>Мій email: <a href="mailto:admin@alexproger.com">admin@alexproger.com</a></p><br>
                    <hr>
                    <p>BackEnd розробник!</p>
                    <p>Мій диплом: <a href="https://itproger.com/view-diplom/4216fe8a6cb36b420699962fabfd2b5d/back-end" target="_blank">посилання</a></p></br>
                    <p>Мої работи:</p>
                    <ul>
                        <li>завантажити: <a href="/public/files/Articles.zip" download>"Статті"</a></li>
                        <li><a href="#shop">"Онлайн магазин" (у розробці)</a></li>
                        <li><a href="#links">"Сайт з укороченням посилань" (у розробці)</a></li>
                    </ul><br>
                    <hr>
                    <p>FrontEnd розробник!</p>
                    <p>Мій диплом: <a href="https://itproger.com/view-diplom/4216fe8a6cb36b420699962fabfd2b5d" target="_blank">посилання</a></p></br>
                    <p>Мої работи:</p>
                    <ul>
                        <li>завантажити: <a href="/public/files/Music.zip" download>"Music"</a></li>
                        <li>завантажити: <a href="/public/files/News_BS.zip" download>"News BS"</a></li>
                        <li>завантажити: <a href="/public/files/Washoo.zip" download>"Washoo"</a></li>
                        
                    </ul>
                </div>
            </div>
            <div class="mess">
                <form action="/contact" method="post" class="form-control">
                    <h1>Напишіть мені:</h1>
                    <input type="text" name="name" placeholder="Введіть ваше ім'я:" value=""><br>
                    <input type="email" name="email" placeholder="Введіть email:" value=""><br>
                    <textarea name="message" placeholder="Напишіть повідомлення:"></textarea><br>

                    <?php if ($data['message'] == 'ok'): ?>
                        <div class="error">Повідомлення надіслано</div>
                    <?php else: ?>
                        <div class="error"><?=$data['message']?></div>
                    <?php endif; ?>

                    <button class="btn mob" id="send">Надіслати</button>
                </form>
            </div>
        </div>
        <div class="space"></div>

        <?php require 'public/blocks/footer.php'; ?>

    </body>
</html>
