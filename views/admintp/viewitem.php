<?php if (file_exists('./views/layouts/header.php')) include('./views/layouts/headeradm.php'); ?>


<content>
    <div class="content">
        <p class="question-row"> Список сообщений от одного юзера</p>

        <div class="mess-wrap">
            <table>
                <?php foreach ($message as $messageItem): ?>
                    <tr>
                        <td class="adm-mes-id"><?php echo $messageItem['id_user']; ?></td>
                        <td class="adm-mes-text"><?php echo $messageItem['message'] ?></td>
                        <td class="adm-mes-date"><?php echo $messageItem['data']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>


        <form class="question-form" action="#" method="post" enctype="multipart/form-data">

            <textarea class="question-area" name="message"></textarea><br/>
            <input class="question-submit" type="submit" name="submit-answer" value="Отправить"/>
        </form>

    </div>


</content>
<footer>
</footer>
</body>
</html>