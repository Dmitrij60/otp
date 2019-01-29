<?php if (file_exists('./views/layouts/header.php')) include('./views/layouts/headeradm.php'); ?>

<content>

    <div class="content-order-list">

        <p class="row-up">Список заявок физ. лиц на тех. присоединение</p>
        <table class="table-bordered-fiz">
            <tr>
                <th width="160px">ID</th>
                <th width="160px">Ф.И.О.</th>
                <th width="160px">СНИЛС</th>
                <th width="160px">E-mail</th>
                <th width="160px">Телефон</th>
                <th width="160px">Район</th>
                <th width="160px">Дата заявки</th>
                <th width="160x">Текущий статус</th>
                <th width="160px">Док-ты</th>
                <th width="160px">Изменить статус</th>
                <th width="158px">Код</th>
            </tr>
            <?php foreach ($orderList as $order): ?>

                <tr>
                    <td width="150px"><?php echo $order['id']; ?></td>
                    <td width="150px"><?php echo $order['fio']; ?></td>
                    <td width="150px"><?php echo $order['snils']; ?></td>
                    <td width="150px"><?php echo $order['email']; ?></td>
                    <td width="150px"><?php echo $order['phone']; ?></td>
                    <td width="150px"><?php echo $order['district_name']; ?></td>
                    <td width="150px"><?php echo date('d.m.y H:i', strtotime($order['date'])); ?></td>
                    <td width="150px"><?php echo $order['online_status']; ?></td>
                    <td class="red" width="150px"><a href="/admin/fiz/files/<?php echo $order['user_id']; ?>"
                                                     title="Редактировать"><img
                                    src="/template/images/home/files.png"></a></td>
                    <td class="red" width="150px"><a href="/admin/fiz/update/<?php echo $order['id']; ?>"
                                                     title="Редактировать"><img src="/template/images/home/red.png"></a>
                    </td>
                    <td width="150px"><?php echo $order['code']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php echo $pagination->get(); ?>
    </div>

</content>

<footer>

</footer>

</body>
</html>