<?php

class CabinetController
{


    public function actionIndex()
    {
        //Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();
        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);
        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }


    public function actionSendOrder()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();
        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);
        $result = false;
        if (isset($_POST['submit'])) {
            $option['user_id'] = $userId;
            $option['status'] = htmlspecialchars(stripslashes($_POST['status']));
            $option['district'] = htmlspecialchars(stripslashes($_POST['district']));
            $option['fio'] = htmlspecialchars(stripslashes($_POST['fio']));
            $option['phone'] = htmlspecialchars(stripslashes($_POST['phone']));
            $option['email'] = htmlspecialchars(stripslashes($_POST['email']));
            $option['org'] = htmlspecialchars(stripslashes($_POST['org']));
            $option['fio_org'] = htmlspecialchars(stripslashes($_POST['fio_org']));
            $option['fact_addr'] = htmlspecialchars(stripslashes($_POST['fact_addr']));
            $option['ur_addr'] = htmlspecialchars(stripslashes($_POST['ur_addr']));
            $option['inn'] = htmlspecialchars(stripslashes($_POST['inn']));
            $option['location'] = htmlspecialchars(stripslashes($_POST['location']));
            $option['objectname'] = htmlspecialchars(stripslashes($_POST['objectname']));
            $option['area'] = htmlspecialchars(stripslashes($_POST['area']));
            $option['floorsum'] = htmlspecialchars(stripslashes($_POST['floorsum']));
            $option['objectaddr'] = htmlspecialchars(stripslashes($_POST['objectaddr']));
            $option['usetarget'] = htmlspecialchars(stripslashes($_POST['usetarget']));
            $option['day_need'] = htmlspecialchars(stripslashes($_POST['day_need']));
            $option['hour_need'] = htmlspecialchars(stripslashes($_POST['hour_need']));
            $option['hour_need'] = htmlspecialchars(stripslashes($_POST['hour_need']));
            $option['atm_pressure'] = htmlspecialchars(stripslashes($_POST['atm_pressure']));

            $option['building_start'] = htmlspecialchars(stripslashes($_POST['building_start']));
            $option['building_start'] = str_replace('.', '-', $option['building_start']);
            $option['building_start'] = date('Y-m-d', strtotime($option['building_start']));

            $option['building_end'] = htmlspecialchars(stripslashes($_POST['building_end']));
            $option['building_end'] = str_replace('.', '-', $option['building_end']);
            $option['building_end'] = date('Y-m-d', strtotime($option['building_end']));


            $errors = false;
            if (!User::checkPhone($option['phone'])) {
                $errors[] = 'Вы ввели некорректный телефон';
            }
            if (!User::checkEmail($option['email'])) {
                $errors[] = 'Вы ввели некорректный email';
            }
            // Загрузка файлов!Название <input type="file">
            Loader::loadFiles($userId);

            if ($errors == false) {
                $go = "Заявка успешно отправлена";
                $result = Order::sendOrder($option);
            } else {
                $go = "Извините, но Ваша заявка не  была принята, Вы некорректно заполнили форму.";

            }
        }
        require_once(ROOT . '/views/cabinet/order.php');
        return true;
    }


    public function actionStatus()
    {
        $userId = User::checkLogged();
        $orderStatus = Order::getOrderStatus($userId);
        if (isset($_POST['submit'])) {
            Loader::loadFiles($userId);
        }
        require_once(ROOT . '/views/cabinet/orderstatus.php');
        return true;
    }


    public function actionCalcVO()
    {
        $result = '';
        if (isset($_POST['submit'])) {
            $length = htmlspecialchars(stripslashes($_POST['length']));
            $capacity = htmlspecialchars(stripslashes($_POST['capacity']));
            $diameter = htmlspecialchars(stripslashes($_POST['diameter']));
            $capacity = (float)$capacity;
            $length = (float)$length;
            $rate = 8.95;
            settype($diameter, "float");
            $result = ($rate * $capacity) + ($diameter * $length);
        } elseif (isset($_POST['submit2'])) {
            $length = htmlspecialchars(stripslashes($_POST['length']));
            $capacity = htmlspecialchars(stripslashes($_POST['capacity']));
            $diameter = htmlspecialchars(stripslashes($_POST['diameter']));
            $rate = 7.80;
            $result = ($rate * $capacity) + ($diameter * $length);
        }
        require_once(ROOT . '/views/cabinet/calcvo.php');
        return true;
    }


    public function actionMessage()
    {
        $userId = User::checkLogged();
        $message = array();
        $message = Message::getMessageById($userId);
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы

            $options['message'] = htmlspecialchars(stripslashes($_POST['message']));

            // Флаг ошибок в форме
            $errors = false;
            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['message']) || empty($options['message'])) {
                $errors[] = 'Заполните поля';
            }
            if ($errors == false) {
                // Если ошибок нет
                // отправляем сообщение
                $id = Message::sendMessage($options);
            }
        }
        require_once(ROOT . '/views/cabinet/sendmessage.php');
        return true;
    }


    public function actionViewItemMessage($id)
    {
        $message = array();
        $message = Message::getMessageById($id);
        //print_r($message); 
        require_once(ROOT . '/views/cabinet/viewitem.php');
        return true;
    }
}