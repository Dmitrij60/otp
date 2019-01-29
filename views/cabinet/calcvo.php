<?php if (file_exists('./views/layouts/header.php')) include('./views/layouts/header.php'); ?>
<content>
    <div class="content">
        <p class="calc-row">Добро пожаловать в онлайн калькулятор для расчета стоимости технологического присоединения к
            системам водоснабжения и водоотведения.</p>
        <p class="calc-row2">Здесь Вы можете предварительно расчитать стоимость оказания услуг.</p>
        <select name="status" class="calc-select" aria-required="true" onChange="Selected(this)">
            <option value="0" selected="selected">Что будем расчитывать?</option>
            <option value="1">Расчитать водоотведение</option>
            <option value="2">Расчитать водоснабжение</option>
        </select>

        <form class="calc-form" action="#" method="POST" id="Label1" style='display: none;'>
            <p class="calc-row2">Выберите диаметр трубы и способ прокладки</p>
            <select class="calc-select" name="diameter">
                <option value="6372,45">100мм открытый способ прокладки</option>
                <option value="6926,39">160мм открытый способ прокладки</option>
            </select>
            <input type="text" name="capacity" value="" placeholder="Подключаемая нагрузка(М3/сут)">

            <input type="text" name="length" placeholder="Протяженность(км)">
            <input class="calc-submit" type="submit" name="submit" value="Расчитать">
        </form>

        <form class="calc-form" action="#" method="POST" id="Label2" style='display: none;'>
            <p class="calc-row2">Выберите диаметр трубы и способ прокладки</p>
            <select class="calc-select" name="diameter">
                <option value="3519,77">40мм и менее</option>
                <option value="4260,15">65мм открытый способ прокладки</option>
                <option value="5664,37">65мм закрытый способ прокладки</option>
            </select>
            <input type="text" name="capacity" value="" placeholder="Подключаемая нагрузка(М3/сут)"><br>
            <input type="text" name="length" placeholder="Протяженность(км)">
            <input class="calc-submit" type="submit" name="submit2" value="Расчитать">
        </form>
        <p class="calc-result">
            <?php if (!empty($result)) {
                echo 'Предварительная сумма за услугу равна' . $result . ' руб.';
            } ?>
        </p>
    </div>
</content>

<footer>

</footer>
<script>function Selected(a) {
        var label = a.value;
        if (label == 1) {
            document.getElementById("Label1").style.display = 'block';
            document.getElementById("Label2").style.display = 'none';

        } else if (label == 2) {
            document.getElementById("Label1").style.display = 'none';
            document.getElementById("Label2").style.display = 'block';

        } else {
            document.getElementById("Label1").style.display = 'none';
            document.getElementById("Label2").style.display = 'none';

        }
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</body>
</html>