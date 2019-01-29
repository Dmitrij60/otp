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


                <div class="signup-form"><!--sign up form-->
                    <p class="register-ok">Вход в личный кабинет</p>
                    <form action="#" method="post" class="userform" id="useformid">
                        <input class="useform-input" type="text" name="login" placeholder="Логин"
                               value="<?php //echo $email; ?>"/>
                        <input class="useform-input" type="password" name="password" placeholder="Пароль"
                               value="<?php //echo $password; ?>"/>
                        <input class="reg-btn" type="submit" name="submit" class="reg-btn" id="btnSubmit"
                               value="Войти в личный кабинет"/>
                    </form>
                    <p class="restore-link"><a href="/user/restore/">Забыли пароль?Восстановить?</a></p>
                </div><!--/sign up form-->


                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

