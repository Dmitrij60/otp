<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/template/css/stylereset.css"/>
    <link rel="stylesheet" type="text/css" href="/template/css/style.css"/>
    <title>ОГУП "Липецкоблводоканал"</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php header("Content-Type: text/html; charset=utf-8"); ?>
    <script src="../template/js/calendar.js"></script>
</head>
<body>
<header>
    <div class="logo">
        <a href="/"> <img class="graficlogo" src="/template/images/home/shapka4.png" alt="logo"></a>
    </div>

    <nav>

        <div class="navigation">
        </div>

        <form>
            <?php if (User::isGuest()): ?>
                <input type="button" name="" value="Регистрация" class="menu-btn"
                       onclick="javascript:window.location='/user/register'"/>
                <input type="button" name="" value="Вход" class="menu-btn"
                       onclick="javascript:window.location='/user/login'"/>
            <?php else: ?>
                <input type="button" name="" value="Подать заявку" class="menu-btn"
                       onclick="javascript:window.location='/cabinet/order'"/>
                <input type="button" name="" value="Статус заявки" class="menu-btn"
                       onclick="javascript:window.location='/cabinet/status'"/>
                <input type="button" name="" value="Онлайн калькулятор" class="menu-btn"
                       onclick="javascript:window.location='/cabinet/vo'"/>
                <!--<input type="button" name="" value="Задать вопрос" class="menu-btn" onclick="javascript:window.location='/cabinet/message'"/>-->
                <input type="button" name="" value="Выйти из кабинета" class="menu-btn"
                       onclick="javascript:window.location='/user/logout'"/>
            <?php endif; ?>
        </form>

    </nav>

</header>



