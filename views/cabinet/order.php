<?php if (file_exists('./views/layouts/header.php')) include('./views/layouts/header.php'); ?>
<content>
    <div class="content">
        <p class="doc">Подать онлайн заявку на технологическое присоединение</p>
        <div class="doc-text">
            <p> Перечень документов к заявке на подключение (технологическое присоединение) к централизованным системам
                холодного водоснабжения (водоотведения):</p>

            <p>1) копии учредительных документов, а также документы, подтверждающие полномочия лица, подписавшего
                заявление (для физических лиц- ксерокопия паспорта);</p>

            <p>2) нотариально заверенные копии правоустанавливающих документов на земельный участок;</p>

            <p>3) ситуационный план расположения объекта с привязкой к территории населенного пункта;</p>

            <p>4) топографическая карта участка в масштабе 1:500 (со всеми наземными и подземными коммуникациями и
                сооружениями), согласованная с эксплуатирующими организациями;</p>

            <p>5) информация о сроках строительства (реконструкции) и ввода в эксплуатацию строящегося
                (реконструируемого) объекта;</p>

            <p>6) баланс водопотребления и водоотведения подключаемого объекта с указанием целей использования холодной
                воды и распределением объемов подключаемой нагрузки по целям использования, в том числе на
                пожаротушение, периодические нужды, заполнение и опорожнение бассейнов, прием поверхностных сточных
                вод;</p>

            <p>7) сведения о составе и свойствах сточных вод, намеченных к отведению в централизованную систему
                водоотведения;</p>

            <p>8) сведения о назначении объекта, высоте и об этажности зданий, строений, сооружений.</p>

            <p>9) банковские реквизиты (для юридических лиц)</p>

            <p>Заявки на подключение(Выгрузка)</p>
            <a href="/upload/home/orders/1.-Заявка-на-подключение-ВС-для-юр.лиц-1.odt">1. Заявка на подключение ВС для
                юр.лиц</a><br>
            <a href="/upload/home/orders/2.-Заявка-на-подключение-ВО-для-юр.лиц-1.odt">2. Заявка на подключение ВО для
                юр.лиц</a><br>
            <a href="/upload/home/orders/3.-Заявка-на-подключение-ВС-для-физ.лиц-и-согласие-на-обработку-перс.дан-1.odt">3.
                Заявка на подключение ВС для физ.лиц и согласие на обработку перс.дан</a><br>
            <a href="/upload/home/orders/4.-Заявка-на-подключение-ВО-для-физ.лиц-и-согласие-на-обработку-перс-дан-1.odt">4.
                Заявка на подключение ВО для физ.лиц и согласие на обработку перс дан</a><br>
        </div>
        <?php $result = false; ?>
        <?php if ($result): ?>
            <p class="order-ok">Заявка отправлена</p>
        <?php else: ?>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <?php endif; ?>
        <div class="order-form-order">
            <form class="upd-form-order" method="POST" action="#" enctype="multipart/form-data">

                <select name="status" aria-required="true" onChange="Selected(this)">
                    <option value="0" selected="selected">Статус контрагента</option>
                    <option value="1">Физическое лицо</option>
                    <option value="2">Юридическое лицо</option>
                </select>

                <label id="Label42" style='display: none; margin-top:40px;'>Укажите район нахождения подключаемого
                    объекта.</label>
                <select name="district" aria-required="true" id="Label29" style='display: none;' required>
                    <option value="" selected="selected">Выберите район</option>
                    <option value="1">Данков</option>
                    <option value="2">Доброе</option>
                    <option value="3">Задонск</option>
                    <option value="4">Измалково</option>
                    <option value="5">Красное</option>
                    <option value="6">Лебедянь</option>
                    <option value="7">Борино</option>
                    <option value="8">Добринка</option>
                    <option value="9">Лев-Толстой</option>
                    <option value="10">Становое</option>
                    <option value="11">Тербуны</option>
                    <option value="12">Волово</option>
                    <option value="13">Долгоруково</option>
                    <option value="14">Хлевное</option>
                    <option value="15">Усмань</option>
                    <option value="16">Чаплыгин</option>
                </select>


                <?php
                $fio = '';
                $location = '';
                $phone = '';
                $objectname = '';


                ?>

                <label id="Label1" style='display: none;'>Укажите Ваше Ф.И.О. полностью.</label>
                <input id="Label2" type="text" name="fio" placeholder="" style='display: none;'
                       value="<?php echo $fio; ?>">

                <label id="Label3" style='display: none;'>Укажите место жительства.</label>
                <input id="Label4" type="text" name="location" placeholder="" style='display: none;'
                       value="<?php echo $location; ?>">

                <label id="Label5" style='display: none;'>Укажите контактный телефон.</label>
                <input id="Label6" type="text" name="phone" placeholder="" style='display: none;'
                       value="<?php echo $phone; ?>" required>

                <label id="Label7" style='display: none;'>Укажите наименование объекта.</label>
                <input id="Label8" type="text" name="objectname"
                       placeholder="производственное здание, индивидуальный или многоквартирный дом, общественное, административное, бытовое здание и тд."
                       style='display: none;' value="<?php echo $objectname; ?>" required>

                <label id="Label9" style='display: none;'>Общая площадь объекта.</label>
                <input id="Label10" type="text" name="area" style='display: none;' required>

                <label id="Label11" style='display: none;'>Количество этажей.</label>
                <input id="Label12" type="text" name="floorsum" style='display: none;' required>

                <label id="Label13" style='display: none;'>Адрес объекта.</label>
                <input id="Label14" type="text" name="objectaddr" style='display: none;' required>

                <label id="Label15" style='display: none;'>Назначение использования.</label>
                <input id="Label16" type="text" name="usetarget"
                       placeholder="производственные нужды, хозяйственно-бытовые нужды." style='display: none;'
                       required>

                <label id="Label17" style='display: none;'>Суточная потребность.</label>
                <input id="Label18" type="text" name="day_need" placeholder="" style='display: none;' required>

                <label id="Label19" style='display: none;'>Часовая потребность.</label>
                <input id="Label20" type="text" name="hour_need" placeholder="" style='display: none;' required>

                <label id="Label25" style='display: none;'> Давление в точке подключения(необязательно для физ.
                    лиц).</label>
                <input id="Label26" type="text" name="atm_pressure" placeholder="" style='display: none;'>

                <label id="Label21" style='display: none;'>Планируемые сроки строительства объекта(начало).</label>
                <input type="text" id="Label22" name="building_start" readonly="readonly" style='display: none;'
                       size="10" onclick="showcalendar(this)"/>

                <!-- <input id="Label22" type="text" name="building_start" placeholder="" style='display: none;'  >-->

                <label id="Label23" style='display: none;'>Планируемые сроки строительства объекта(конец).</label>
                <input type="text" id="Label24" name="building_end" readonly="readonly" style='display: none;' size="10"
                       onclick="showcalendar(this)"/>

                <!--<input id="Label24" type="text" name="building_end" placeholder="" style='display: none;'  >-->

                <label id="Label27" style='display: none;'>Укажите Ваш E-mail адрес.</label>
                <input id="Label28" type="email" name="email" placeholder="" style='display: none;' required>

                <label id="Label30" style='display: none;'>Укажите наименование организации.</label>
                <input id="Label31" type="text" name="org" placeholder="" style='display: none;'>

                <label id="Label32" style='display: none;'>Укажите Ваш ИНН.</label>
                <input id="Label33" type="text" name="inn" placeholder="" style='display: none;'>

                <label id="Label34" style='display: none;'>Укажите Ф.И.О. руководителя организации.</label>
                <input id="Label35" type="text" name="fio_org" placeholder="" style='display: none;'>

                <label id="Label36" style='display: none;'>Укажите юридический адрес.</label>
                <input id="Label37" type="text" name="ur_addr" placeholder="" style='display: none;'>

                <label id="Label38" style='display: none;'>Укажите фактический адрес.</label>
                <input id="Label39" type="text" name="fact_addr" placeholder="" style='display: none;'>


                <label id="Label40" style='display: none;'>Прикрепить документы(Выделите все <a
                            href="/upload/home/orders/Vipnet.pdf">подписанные ЭЦП</a> документы в .sig формате и
                    добавьте перед отправкой формы):</label>
                <input id="Label41" type="file" name="file[]" placeholder="" style='display: none;' multiple>

                <input class="upd-submit-order" type="submit" name="submit" value="Подать заявку">
            </form>

        </div>


    </div>
</content>

<footer>

</footer>
<script></script>

<script>function Selected(a) {
        var label = a.value;
        if (label == 1) {
            document.getElementById("Label1").style.display = 'block';
            document.getElementById("Label2").style.display = 'block';
            document.getElementById("Label3").style.display = 'block';
            document.getElementById("Label4").style.display = 'block';
            document.getElementById("Label5").style.display = 'block';
            document.getElementById("Label6").style.display = 'block';
            document.getElementById("Label7").style.display = 'block';
            document.getElementById("Label8").style.display = 'block';
            document.getElementById("Label9").style.display = 'block';
            document.getElementById("Label10").style.display = 'block';
            document.getElementById("Label11").style.display = 'block';
            document.getElementById("Label12").style.display = 'block';
            document.getElementById("Label13").style.display = 'block';
            document.getElementById("Label14").style.display = 'block';
            document.getElementById("Label15").style.display = 'block';
            document.getElementById("Label16").style.display = 'block';
            document.getElementById("Label17").style.display = 'block';
            document.getElementById("Label18").style.display = 'block';
            document.getElementById("Label19").style.display = 'block';
            document.getElementById("Label20").style.display = 'block';
            document.getElementById("Label21").style.display = 'block';
            document.getElementById("Label22").style.display = 'block';
            document.getElementById("Label23").style.display = 'block';
            document.getElementById("Label24").style.display = 'block';
            document.getElementById("Label25").style.display = 'block';
            document.getElementById("Label26").style.display = 'block';
            document.getElementById("Label27").style.display = 'block';
            document.getElementById("Label28").style.display = 'block';
            document.getElementById("Label29").style.display = 'block';
            document.getElementById("Label30").style.display = 'none';
            document.getElementById("Label31").style.display = 'none';
            document.getElementById("Label32").style.display = 'block';
            document.getElementById("Label33").style.display = 'block';
            document.getElementById("Label34").style.display = 'none';
            document.getElementById("Label35").style.display = 'none';
            document.getElementById("Label36").style.display = 'none';
            document.getElementById("Label37").style.display = 'none';
            document.getElementById("Label38").style.display = 'none';
            document.getElementById("Label39").style.display = 'none';
            document.getElementById("Label40").style.display = 'block';
            document.getElementById("Label41").style.display = 'block';
            document.getElementById("Label42").style.display = 'block';


        } else if (label == 2) {
            document.getElementById("Label1").style.display = 'none';
            document.getElementById("Label2").style.display = 'none';
            document.getElementById("Label3").style.display = 'none';
            document.getElementById("Label4").style.display = 'none';
            document.getElementById("Label5").style.display = 'block';
            document.getElementById("Label6").style.display = 'block';
            document.getElementById("Label7").style.display = 'block';
            document.getElementById("Label8").style.display = 'block';
            document.getElementById("Label9").style.display = 'block';
            document.getElementById("Label10").style.display = 'block';
            document.getElementById("Label11").style.display = 'block';
            document.getElementById("Label12").style.display = 'block';
            document.getElementById("Label13").style.display = 'block';
            document.getElementById("Label14").style.display = 'block';
            document.getElementById("Label15").style.display = 'block';
            document.getElementById("Label16").style.display = 'block';
            document.getElementById("Label17").style.display = 'block';
            document.getElementById("Label18").style.display = 'block';
            document.getElementById("Label19").style.display = 'block';
            document.getElementById("Label20").style.display = 'block';
            document.getElementById("Label21").style.display = 'block';
            document.getElementById("Label22").style.display = 'block';
            document.getElementById("Label23").style.display = 'block';
            document.getElementById("Label24").style.display = 'block';
            document.getElementById("Label25").style.display = 'block';
            document.getElementById("Label26").style.display = 'block';
            document.getElementById("Label27").style.display = 'block';
            document.getElementById("Label28").style.display = 'block';
            document.getElementById("Label29").style.display = 'block';
            document.getElementById("Label30").style.display = 'block';
            document.getElementById("Label31").style.display = 'block';
            document.getElementById("Label32").style.display = 'block';
            document.getElementById("Label33").style.display = 'block';
            document.getElementById("Label34").style.display = 'block';
            document.getElementById("Label35").style.display = 'block';
            document.getElementById("Label36").style.display = 'block';
            document.getElementById("Label37").style.display = 'block';
            document.getElementById("Label38").style.display = 'block';
            document.getElementById("Label39").style.display = 'block';
            document.getElementById("Label40").style.display = 'block';
            document.getElementById("Label41").style.display = 'block';
            document.getElementById("Label42").style.display = 'block';


        } else {
            document.getElementById("Label1").style.display = 'none';
            document.getElementById("Label2").style.display = 'none';
            document.getElementById("Label3").style.display = 'none';
            document.getElementById("Label4").style.display = 'none';
            document.getElementById("Label5").style.display = 'none';
            document.getElementById("Label6").style.display = 'none';
            document.getElementById("Label7").style.display = 'none';
            document.getElementById("Label8").style.display = 'none';
            document.getElementById("Label9").style.display = 'none';
            document.getElementById("Label10").style.display = 'none';
            document.getElementById("Label11").style.display = 'none';
            document.getElementById("Label12").style.display = 'none';
            document.getElementById("Label13").style.display = 'none';
            document.getElementById("Label14").style.display = 'none';
            document.getElementById("Label15").style.display = 'none';
            document.getElementById("Label16").style.display = 'none';
            document.getElementById("Label17").style.display = 'none';
            document.getElementById("Label18").style.display = 'none';
            document.getElementById("Label19").style.display = 'none';
            document.getElementById("Label20").style.display = 'none';
            document.getElementById("Label21").style.display = 'none';
            document.getElementById("Label22").style.display = 'none';
            document.getElementById("Label23").style.display = 'none';
            document.getElementById("Label24").style.display = 'none';
            document.getElementById("Label25").style.display = 'none';
            document.getElementById("Label26").style.display = 'none';
            document.getElementById("Label27").style.display = 'none';
            document.getElementById("Label28").style.display = 'none';
            document.getElementById("Label29").style.display = 'none';
            document.getElementById("Label30").style.display = 'none';
            document.getElementById("Label31").style.display = 'none';
            document.getElementById("Label32").style.display = 'none';
            document.getElementById("Label33").style.display = 'none';
            document.getElementById("Label34").style.display = 'none';
            document.getElementById("Label35").style.display = 'none';
            document.getElementById("Label36").style.display = 'none';
            document.getElementById("Label37").style.display = 'none';
            document.getElementById("Label38").style.display = 'none';
            document.getElementById("Label39").style.display = 'none';
            document.getElementById("Label40").style.display = 'none';
            document.getElementById("Label41").style.display = 'none';

        }
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</body>
</html>