<?php if (file_exists('./views/layouts/header.php')) include('./views/layouts/header.php'); ?>
<content>
    <div class="content-start-page">
        <p class="central-title">Компания ОГУП "Липецкоблводоканал" приветствует Вас.</p>
        <p class="central-title-2"> На странице сервиса подачи онлайн заявок на технологическое
            присоединение("ОнлайнТП").</p>
        <p class="middle-title"> Здесь Вы можете, а мы поможем, подать онлайн заявку на технологическое
            присоединение, увидеть в реальном времени этап на котором находится Ваша заявка(Далее статус заявки),
            расчитать стоимость услуги и многое другое.</p>
        <p class="bottom-title">К сожалению, вы не можете войти на эту страницу, т.к. не авторизованы на сайте.
            Возможно, вы уже являетесь нашим зарегистрированным пользователем?</p>
        <div class="">
            <?php if (User::isGuest()): ?>
            <div class="reg-link-button">
                <p><a href="/user/login">Войти в личный кабинет</a></p>
            </div>
        </div>

        <div class="">
            <p class="bottom-title">Вы еще не зарегистрированы? Тогда Вы можете пройти процедуру регистрации прямо
                сейчас!
                Предупреждаем, что для регистрации вам потребуется указать свой настоящий E-Mail адрес - без
                работоспособного
                адреса вы не сможете зарегистрироваться на нашем сайте.</p>
            <div class="reg-wraper">
                <div class="reg-fiz">
                    <div class="reg-link-button">
                        <p><a href="/user/register">Зарегистрироваться </a></p>
                    </div>
                </div>
            </div>

            <?php else: ?>
            <div class="reg-link-button">
                <p><a href="/user/logout">Выход из личного кабинета</a></p>
            </div>
            <div class="reg-link-button">
                <p><a href="/cabinet/">Личный кабинет</a></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</content>

<footer>

</footer>
</body>
</html>