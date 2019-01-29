<?php if (file_exists('./views/layouts/header.php')) include './views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
                <?php if ($result): ?>
                    <p class="register-ok">Вы зарегистрированы!</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <p class="register-ok"><?php echo $error; ?></p></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form"><!--sign up form-->
                        <p class="register-ok">Регистрация на сайте</p>
                        <form action="#" method="post" class="userform" onsubmit="return sendForm()">
                            <input class="useform-input" type="text" name="login" placeholder="Введите логин"
                                   value="<?php echo $login; ?>"/>
                            <input class="useform-input" type="email" name="email" placeholder="Введите Ваш email"
                                   value=""/>
                            <input class="useform-input" type="password" name="password" placeholder="Введите пароль"
                                   value=""/>

                            <input class="useform-input" type="password" name="password1"
                                   placeholder="Введите повторно пароль" value=""/>

                            <div class="input-w">
                                <label class="reg-check-text"> <input type="checkbox" class="checkbox">Я даю согласие на
                                    обработку персональных данных. </label>
                            </div>


                            <div class="g-recaptcha" data-sitekey="6Lduj4EUAAAAAMgXbCVgDilSkRPVnoQBvMAXxK2S"></div>
                            <!-- элемент для вывода ошибок -->
                            <div class="text-danger" id="recaptchaError"></div>
                            <input type="submit" name="submit" class="reg-btn" id="btnSubmit" value="Регистрация"
                                   disabled/>

                            <!-- <button type="button" class="btn" disabled>Кнопка</button> -->

                        </form>
                    </div><!--/sign up form-->

                <?php endif; ?>
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<script>function sendForm() {
        var v = grecaptcha.getResponse();
        if (v.length == '') {
            $('#captcha').text('Пройдите валидацию reCAPCHA');
            return false;
        }
        else {
            return true;
        }
    }
</script>

<script>
    document.querySelector(".checkbox").addEventListener("change", function () {
        document.querySelector(".reg-btn").disabled = !document.querySelector(".checkbox").checked;
    });
</script>
        
         
