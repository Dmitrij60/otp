<?php

class Message
{

    public static function sendMessage($options)
    {
        $db = Db::getConnection();

        $id_user = User::checkLogged();


        $sql = "INSERT INTO messages (id_user,message) VALUES
	    (:id_user,:message)";
        $result = $db->prepare($sql);
        $result->bindValue(':id_user', $id_user);
        $result->bindValue(':message', $options['message']);

        if ($result->execute()) {
            // Если запрос выполенен успешно
            return $result;
        }
        // Иначе возвращаем 0
        return 0;
    }


    public static function viewMessages()
    {
        $db = Db::getConnection();
        $userTo = User::checkLogged();


        $sql = "SELECT DISTINCT `messages`.*, users.`login`  FROM `messages` INNER JOIN `users` ON (messages.`id_user` = users.`user_id`) GROUP BY `id_user` DESC HAVING COUNT(*)>=1 ORDER BY data DESC";
        $result = $db->prepare($sql);
        $result->bindParam(':id_user', $userTo, PDO::PARAM_INT);
        $result->execute();
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;

    }

    /**
     * Достаем сообщение. Помимо номера сообщения ориентируемся и на id пользователя
     * Это исключит возможность чтения чужого сообщения, методом подбора id сообщения
     */

    public static function getMessageById($id_user)
    {
        $messList = array();
        $id = intval($id_user);
        if ($id_user) {
            $db = Db::getConnection();
            $userTo = User::checkLogged();
            $result = $db->query('SELECT * FROM messages WHERE id_user = ' . $id_user);
            $i = 0;
            while ($row = $result->fetch()) {
                $messList[$i]['id'] = $row['id'];
                $messList[$i]['id_user'] = $row['id_user'];
                $messList[$i]['message'] = $row['message'];
                $messList[$i]['data'] = $row['data'];
                $i++;
            }
            return $messList;
        }
    }


    public static function setAnswerById($id_user, $message)
    {
        $db = Db::getConnection();


        $sql = "INSERT INTO messages (id_user,message) VALUES
	    (:id_user,:message)";
        $result = $db->prepare($sql);
        $result->bindValue(':id_user', $id_user);
        $result->bindValue(':message', $message);

        if ($result->execute()) {
            // Если запрос выполенен успешно
            return $result;
        }
        // Иначе возвращаем 0
        return 0;

    }


}