<?php if (file_exists('./views/layouts/header.php')) include('./views/layouts/headeradm.php'); ?>

<content>


    <div class="content-order-list">
        <p class="row-up">Документы загруженные пользователем</p>

        <?php foreach ($files as $file) {
            if (!in_array($file, $skip))

                echo "<li class='file-list'><a class='open-file' href='$path$file' >$file</a> <a class='download-file' href='$path$file' download >Скачать</a></li>  <br>";

        } ?>


    </div>
</content>

<footer>

</footer>

</body>
</html>