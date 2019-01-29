<?php if (file_exists('./views/layouts/header.php')) include './views/layouts/header.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4 padding-right">
                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li> - <p class="register-ok"><?php echo $error; ?></p></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <div class="restore-form"><!--sign up form-->
                    <p class="register-ok">Восстановление пароля</p>
                    <div class="content">
                        <div class="restore-text">
                            <p>К сожалению, мы не можем напомнить вам ваш старый пароль,
                                т.к. он хранится в базе данных в зашифрованном виде и не поддается
                                обратной дешифровке. Однако мы можем сгенерировать новый случайный пароль
                                и выслать его вам по электронной почте почте. Зайдя с новым паролем на сайт,
                                вы сможете поменять пароль на другой.
                            </p>
                            <form class="restore-form" method="POST">
                                <label>Введите E-mail, который Вы указывали при регистрации:</label><br>
                                <input type="text" size="20" name="email"><br>
                                <input type="submit" value="Восстановить пароль" name="submit">
                            </form>
                        </div>
                    </div>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section>