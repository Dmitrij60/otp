<?php if (file_exists('./views/layouts/header.php')) include('./views/layouts/header.php'); ?>

<content>
    <div class="content">

        <p class="question-row"> Здесь Вы можете задать все интересующие Вас вопросы квалифицируемому специалисту по
            технологическому присоединению.</p>

        <div class="mess-wrap">
            <table class="message-table">
                <!--<th>id</th>-->
                <th>Сообщение</th>
                <th>Дата</th>
                <?php if (!empty($message)) foreach ($message as $messageItem): ?>
                    <tr>
                        <!--<td adm-mes-id><?php //echo $messageItem['id_user']; ?></td>-->
                        <td class="adm-mes-text"><?php echo $messageItem['message'] ?></td>
                        <td class="adm-mes-date"><?php echo date('d.m.y H:i', strtotime($messageItem['data'])); ?></td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </div>


        <form class="question-form" action="#" method="post" enctype="multipart/form-data">

            <textarea class="question-area" name="message"></textarea><br/>
            <input class="question-submit" type="submit" name="submit" value="Отправить"/>
        </form>
    </div>


</content>
<footer>
</footer>
</body>
</html>