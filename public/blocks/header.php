<header>
    <div class="conteiner top-menu">
        <div class="logo">
                <img src="/public/imgs/logo1.svg" alt="Logo">
                <span><a href="/port/">AlexProger</a></span>
        </div>
        <div class="nav">

            <?php if ($data['mobile']): ?>

                <div class="dropdown">
                    <button onclick="myFunction()" class="dropbtn">МЕНЮ</button>
                    <div id="myDropdown" class="dropdown-content">
                        <a href="/">Головна</a>

                        <?php if ($_COOKIE['login'] == ''): ?>

                            <a href="/user/auth">Увійти</a>

                        <?php else: ?>

                            <?php if ($data['user']->name == 'none'): ?>

                                <a href="/user/dashboard"><?=$data['user']->email?></a>

                            <?php else: ?>

                                <a href="/user/dashboard"><?=$data['user']->name?></a>

                            <?php endif; ?>

                        <?php endif; ?>

                        <a href="/contact/gallery">Галерея</a>
                        <a href="/contact">Контакти</a>
                    </div>
                </div>

            <?php else: ?>

                <a href="/">Головна</a>

                <?php if ($_COOKIE['login'] == ''): ?>

                    <a href="/user/auth">Увійти</a>

                <?php else: ?>

                    <?php if ($data['user']->name == 'none'): ?>

                        <a href="/user/dashboard"><?=$data['user']->email?></a>

                    <?php else: ?>

                        <a href="/user/dashboard"><?=$data['user']->name?></a>

                    <?php endif; ?>

                <?php endif; ?>

                <a href="/contact/gallery">Галерея</a>
                <a href="/contact">Контакти</a>

            <?php endif; ?>

        </div>
    </div>

    <script>
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</header>