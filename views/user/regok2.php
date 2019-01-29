<?php if (file_exists('./views/layouts/header.php')) include('./views/layouts/header.php'); ?>

<content>
    <div class="content">
        <div class="regok">
               Ваш аккаунт подтвержден! Можете войти в личный кабинет онлайнТП, используя введенный Вами логин и пароль.
            </div>
        <p class="regok">Запомните Ваш логин и пароль, для осуществления возможности входа в личный кабинет на нашем
            сайте.</p>

        <input type="button" name="" value="Вход" class="menu-btn-regok"
               onclick="javascript:window.location='/user/login'"/>

    </div>
</content>

<footer>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</body>
</html>