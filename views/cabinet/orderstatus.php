<?php if (file_exists('./views/layouts/header.php')) include('./views/layouts/header.php'); ?>
<content>
    <div class="content-start-page">
        <div class="form-order-status">
            <p>Здесь Вы можете отследить статус поданной заявки, а так же прикрепить документы к ранее поданой заявке.
                Выберите статус, который Вы указывали при подаче заявки:
            </p>
            <select name="status" aria-required="true" onChange="Selected(this)">
                <option value="0" selected="selected">Статус контрагента</option>
                <option value="1">Физическое лицо</option>
                <option value="2">Юридическое лицо</option>
            </select>
        </div>
        <table id="Label1" class="table-bordered-fiz" style='display: none;'>
            <tr>
                <th width="160px">Ф.И.О.</th>
                <th width="160px">Код заявки</th>
                <th width="160px">Дата подачи заявки</th>
                <th width="160px">Этап оплаты 1</th>
                <th width="160px">Этап оплаты 2</th>
                <th width="160px">Этап оплаты 3</th>
                <th width="160px">Осталось оплатить</th>
                <th width="160px">Текущий статус</th>
            </tr>

            <?php foreach ($orderStatus as $order): ?>
                <tr>
                    <?php if (empty($order['fio'])) {
                        $order['date'] = null;
                        $order['online_status'] = null;
                        $order['stage_1'] = null;
                        $order['stage_2'] = null;
                        $order['stage_3'] = null;
                        $order['remained_paid'] = null;
                        $order['code'] = null;
                    } ?>
                    <td width="150px"><?php echo $order['fio']; ?></td>
                    <td width="150px"><?php echo $order['code']; ?></td>
                    <td width="150px"><?php if (!empty($order['fio'])) {
                            echo date('d.m.y', strtotime($order['date']));
                        } ?></td>
                    <td width="150px"><?php echo $order['stage_1']; ?></td>
                    <td width="150px"><?php echo $order['stage_2']; ?></td>
                    <td width="150px"><?php echo $order['stage_3']; ?></td>
                    <td width="150px"><?php echo $order['remained_paid']; ?></td>
                    <td width="150px"><?php echo $order['online_status']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <table id="Label2" class="table-bordered-ur" style='display: none;'>
            <tr>
                <th width="160px">Организация</th>
                <th width="160px">ИНН</th>
                <th width="160px">Код заявки</th>
                <th width="160px">Дата подачи заявки</th>
                <th width="160px">Этап оплаты 1</th>
                <th width="160px">Этап оплаты 2</th>
                <th width="160px">Этап оплаты 3</th>
                <th width="160px">Осталось оплатить</th>

                <th width="158px">Текущий статус</th>
            </tr>

            <?php foreach ($orderStatus as $order): ?>
                <tr>
                    <?php if (empty($order['org'])) {
                        $order['date'] = null;
                        $order['online_status'] = null;
                        $order['stage_1'] = null;
                        $order['stage_2'] = null;
                        $order['stage_3'] = null;
                        $order['remained_paid'] = null;
                        $order['code'] = null;
                    } ?>
                    <td width="150px"><?php echo $order['org']; ?></td>
                    <td width="150px"><?php echo $order['inn']; ?></td>
                    <td width="150px"><?php echo $order['code']; ?></td>
                    <td width="150px"><?php if (!empty($order['org'])) {
                            echo date('d.m.y', strtotime($order['date']));
                        } ?></td>
                    <td width="150px"><?php echo $order['stage_1']; ?></td>
                    <td width="150px"><?php echo $order['stage_2']; ?></td>
                    <td width="150px"><?php echo $order['stage_3']; ?></td>
                    <td width="150px"><?php echo $order['remained_paid']; ?></td>
                    <td width="150px"><?php echo $order['online_status']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <form class="upd-form-order" method="POST" action="#" enctype="multipart/form-data">
            <label id="Label26 " style='display: ;'>Добавить документ</label>
            <input id="Label27" type="file" name="file[]" placeholder="" style='display: ;' multiple>
            <input class="upd-submit-order" type="submit" name="submit" value="Добавить файл">
        </form>
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