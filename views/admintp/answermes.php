<?php if (file_exists('./views/layouts/header.php')) include('./views/layouts/headeradm.php'); ?>


<content>
    <div class="content">
        <p class="question-row"> Список сообщений</p>
        <div class="mess-wrap">
            <table class="message-table">
                <?php foreach ($messages as $messageItem): ?>
                    <tr>
                        <td class="adm-mes-id"><?php echo $messageItem['login']; ?></td>
                        <td class="adm-mes-text"><p><a
                                        href="/admin/viewItemMessage/<?php echo $messageItem['id_user']; ?>"> <?php echo $messageItem['message'] ?></a>
                            </p></td>
                        <td class="adm-mes-date"><?php echo date('d.m.y H:i', strtotime($messageItem['data'])); ?></td>

                    </tr>
                <?php endforeach; ?>
        </div>
        </table>
    </div>

</content>
<footer>
</footer>
</body>
</html>