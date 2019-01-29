<?php if (file_exists('./views/layouts/header.php')) include('./views/layouts/headeradm.php'); ?>
<content>
    <div class="content-order-list">
        <p class="row-up">Редактировать заявку юридического лица</p>
        <table class="table-bordered-ur">
            <tr>
                <th width="160px">ID</th>
                <th width="160px">E-mail</th>
                <th width="160px">Телефон</th>
                <th width="160px">Организация</th>
                <th width="160px">ИНН</th>
                <th width="160px">ОГРН</th>
                <th width="160px">КПП</th>
                <th width="160px">Дата заявки</th>
                <th width="158px">Текущий статус</th>
            </tr>
            <tr>
                <td width="150px"><?php echo $order['id']; ?></td>
                <td width="150px"><?php echo $order['email']; ?></td>
                <td width="150px"><?php echo $order['phone']; ?></td>
                <td width="150px"><?php echo $order['org']; ?></td>
                <td width="150px"><?php echo $order['inn']; ?></td>
                <td width="150px"><?php echo $order['ogrn']; ?></td>
                <td width="150px"><?php echo $order['kpp']; ?></td>
                <td width="150px"><?php echo date('d.m.y H:i', strtotime($order['date'])); ?></td>
                <td width="150px"><?php echo $order['online_status']; ?></td>
            </tr>

        </table>

        <form class="upd-form" method="POST" action="#">
            <input type="text" name="code" placeholder="000/18-вс-дл"
                   pattern="[0-9][0-9][0-9]\/[0-9][0-9]-[вВ][оОсС]-[дДлЛчЧсСкКиИзЗвВтТхХуУ][нНтТпПрРбБзЗлЛсС]"/>
            <br>

            <select name="online_status">
                <option value="заявка на рассмотрении">заявка на рассмотрении</option>
                <option value="заявка на подписании">заявка на подписании</option>
                <option value="заявка в работе">заявка в работе</option>
                <option value="В заявке отказано">В заявке отказано</option>
                <option value="Заявка завершена">заявка завершена</option>
            </select>
            <input class="upd-submit" type="submit" name="submit" value="Изменить статус заявки">
        </form>


    </div>
</content>

<footer>

</footer>

</body>
</html>