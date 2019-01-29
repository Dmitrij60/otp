<?php

class Order
{

    const SHOW_BY_DEFAULT = 8;


    public static function sendOrder($option)
    {
        $db = Db::getConnection();
        //user_id, status, fio, district_id, email, phone, org, fio_org, fact_addr, ur_addr, atm_pressure '
        //         . 'inn, location, objectname, area, floorsum, objectaddr, usetarget, day_need, hour_need, building_start, building_end
        // Текст запроса к БД
        $sql = 'INSERT INTO orders '
            . '(user_id, status, fio, district_id, email, phone, org, fio_org, fact_addr, ur_addr, atm_pressure, inn, location,'
            . 'objectname, area, floorsum, objectaddr, usetarget, day_need, hour_need, building_start, building_end)'
            . 'VALUES '
            . '(:user_id, :status, :fio, :district_id, :email, :phone, :org, :fio_org, :fact_addr, :ur_addr, :atm_pressure, :inn, :location,'
            . ' :objectname, :area, :floorsum, :objectaddr, :usetarget, :day_need, :hour_need, :building_start, :building_end)';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $option['user_id'], PDO::PARAM_INT);
        $result->bindParam(':status', $option['status'], PDO::PARAM_STR);
        $result->bindParam(':fio', $option['fio'], PDO::PARAM_STR);
        $result->bindParam(':district_id', $option['district'], PDO::PARAM_STR);
        $result->bindParam(':email', $option['email'], PDO::PARAM_STR);
        $result->bindParam(':phone', $option['phone'], PDO::PARAM_STR);

        $result->bindParam(':org', $option['org'], PDO::PARAM_STR);
        $result->bindParam(':fio_org', $option['fio_org'], PDO::PARAM_STR);
        $result->bindParam(':fact_addr', $option['fact_addr'], PDO::PARAM_STR);
        $result->bindParam(':ur_addr', $option['ur_addr'], PDO::PARAM_STR);
        $result->bindParam(':atm_pressure', $option['atm_pressure'], PDO::PARAM_STR);
        $result->bindParam(':inn', $option['inn'], PDO::PARAM_STR);
        $result->bindParam(':location', $option['location'], PDO::PARAM_STR);
        $result->bindParam(':objectname', $option['objectname'], PDO::PARAM_STR);
        $result->bindParam(':area', $option['area'], PDO::PARAM_STR);
        $result->bindParam(':floorsum', $option['floorsum'], PDO::PARAM_STR);
        $result->bindParam(':objectaddr', $option['objectaddr'], PDO::PARAM_STR);
        $result->bindParam(':usetarget', $option['usetarget'], PDO::PARAM_STR);
        $result->bindParam(':day_need', $option['day_need'], PDO::PARAM_STR);
        $result->bindParam(':hour_need', $option['hour_need'], PDO::PARAM_STR);
        $result->bindParam(':building_start', $option['building_start'], PDO::PARAM_STR);
        $result->bindParam(':building_end', $option['building_end'], PDO::PARAM_STR);
        if ($result->execute()) {

            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();

        } else {
            echo ' <p class="order-ok">Извините, но Ваша заявка не была отправлена. </p>';
        }
        // Иначе возвращаем 0
        return 0;
    }


    public static function getOrderStatus($userId, $count = self::SHOW_BY_DEFAULT)
    {

        $db = Db::getConnection();
        $result = $db->query('SELECT * FROM users, orders WHERE users.user_id = orders.user_id AND orders.user_id = ' . $userId . ' ORDER BY id DESC LIMIT ' . $count);
        $orderList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $orderList[$i]['id'] = $row['id'];
            $orderList[$i]['fio'] = $row['fio'];
            $orderList[$i]['email'] = $row['email'];
            $orderList[$i]['phone'] = $row['phone'];
            $orderList[$i]['org'] = $row['org'];
            $orderList[$i]['inn'] = $row['inn'];
            $orderList[$i]['date'] = $row['date'];
            $orderList[$i]['code'] = $row['code'];
            $orderList[$i]['stage_1'] = $row['stage_1'];
            $orderList[$i]['stage_2'] = $row['stage_2'];
            $orderList[$i]['stage_3'] = $row['stage_3'];
            $orderList[$i]['remained_paid'] = $row['remained_paid'];
            $orderList[$i]['online_status'] = $row['online_status'];
            $i++;
        }
        return $orderList;

    }


    /*  $result = $db->query('SELECT * FROM orders WHERE user_id = '.$id);
      $result->setFetchMode(PDO::FETCH_ASSOC);
      return $result->fetch();
      }*/


    public static function getOrderById($id)
    {
        $id = intval($id);
        if ($id) {
            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM orders WHERE id = ' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            return $result->fetch();
        }
    }

    public static function getOrderUrList($page = 1)
    {
        $count = self::SHOW_BY_DEFAULT;
        $page = intval($page);
        $offset = ($page - 1) * $count;
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT orders.*, district.district_name, district.district_id FROM orders inner join district on orders.district_id=district.id WHERE status = "2" ORDER BY orders.id DESC  LIMIT ' . $count . ' OFFSET ' . $offset);

        $orderList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $orderList[$i]['id'] = $row['id'];
            $orderList[$i]['user_id'] = $row['user_id'];
            $orderList[$i]['email'] = $row['email'];
            $orderList[$i]['phone'] = $row['phone'];
            $orderList[$i]['district_name'] = $row['district_name'];
            $orderList[$i]['org'] = $row['org'];
            $orderList[$i]['inn'] = $row['inn'];
            $orderList[$i]['ogrn'] = $row['ogrn'];
            $orderList[$i]['kpp'] = $row['kpp'];
            $orderList[$i]['date'] = $row['date'];
            $orderList[$i]['online_status'] = $row['online_status'];
            $orderList[$i]['code'] = $row['code'];
            $i++;
        }
        return $orderList;
    }

    public static function getOrderFizList($page = 1)
    {
        $count = self::SHOW_BY_DEFAULT;
        $page = intval($page);
        $offset = ($page - 1) * $count;
        $db = Db::getConnection();
        // Получение и возврат результатов

        $result = $db->query('SELECT orders.*, district.district_name, district.district_id FROM orders inner join district on orders.district_id=district.id WHERE status = "1" ORDER BY orders.id DESC  LIMIT ' . $count . ' OFFSET ' . $offset);
        $orderList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $orderList[$i]['id'] = $row['id'];
            $orderList[$i]['user_id'] = $row['user_id'];
            $orderList[$i]['district_name'] = $row['district_name'];
            $orderList[$i]['fio'] = $row['fio'];
            $orderList[$i]['snils'] = $row['snils'];
            $orderList[$i]['email'] = $row['email'];
            $orderList[$i]['phone'] = $row['phone'];
            $orderList[$i]['date'] = $row['date'];
            $orderList[$i]['online_status'] = $row['online_status'];
            $orderList[$i]['code'] = $row['code'];
            $i++;
        }
        return $orderList;
    }


    public static function updateOrderStatusById($id, $option)
    {
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = "UPDATE orders SET online_status = :online_status, code = :code WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':code', $option['code'], PDO::PARAM_STR);
        $result->bindParam(':online_status', $option['online_status'], PDO::PARAM_STR);
        return $result->execute();
    }


    public static function getTotalUrOrders()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM orders '
            . 'WHERE status="2"');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }


    public static function getTotalFizOrders()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM orders '
            . 'WHERE status="1"');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }


}