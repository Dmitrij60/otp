<?php

class User
{
    /**
     * Регистрация пользователя
     * @param type $login
     * @param type $email
     * @param type $password
     * @return type
     */
    public static function register($login, $email, $password, $activation)
    {

        $db = Db::getConnection();


        $sql = 'INSERT INTO users (login, password, email, activation)'
            . 'VALUES(:login, :password, :email, :activation)';
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':activation', $activation, PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Проверяем существует ли пользователь с заданными $email и $password
     * @param string $email
     * @param string $password
     * @return mixed : ingeger user id or false
     */

    public static function checkUserData($login, $password)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM users WHERE login = :login AND password = :password';
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        $user = $result->fetch();

        if ($user) {
            return $user['user_id'];
        }
        return false;


    }

    public static function checkName($login)
    {
        if (strlen($login) >= 2) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет телефон: не меньше, чем 10 символов
     */
    public static function checkPhone($phone)
    {
        if (strlen($phone) >= 10) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет имя: не меньше, чем 6 символов
     */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    public static function checkСoincidencePassword($password, $password1)
    {
        if ($password == $password1) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет email
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }


    public static function checkEmailExists($email)
    {

        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn()) {
            return true;
        } else {
            return false;
        }
    }


    public static function checkNameExists($login)
    {

        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM users WHERE login = :login';

        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn())
            return true;
        return false;
    }


    public static function auth($userId)
    {

        $_SESSION['user'] = $userId;

    }

    public static function checkLogged()
    {
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /user/login");
    }


    public static function getUserById($id)
    {
        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM users WHERE user_id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            // Указываем, что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();


            return $result->fetch();
        }
    }


    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    public static function isAdmin($login, $password)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM users WHERE login = :login AND password = :password';
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        $user = $result->fetch();

        if ($user['role'] == 'Admin') {
            return true;
        }
        return false;
    }

    public static function generateHash($password)
    {
        if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
            $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
            return crypt($password, $salt);
        }
    }


    public static function checkUserDataHash($login)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT * FROM users WHERE login = :login';
        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();
    }


    public static function getUserByEmail($email)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = "SELECT * FROM users WHERE email = :email";
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();
    }


    public static function setRecoveryHashPassword($email, $newmdPassword)
    {
        // Соединение с БД
        $db = Db::getConnection();
        $sql = "UPDATE users SET password = :newmdPassword WHERE email = :email";
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':newmdPassword', $newmdPassword, PDO::PARAM_STR);
        return $result->execute();

    }

    /* public static function searchActivatedAccount($code){
          // Соединение с БД
         $db = Db::getConnection();
          $sql = "SELECT id FROM users WHERE activation = :code and status='0'";
         $result = $db->prepare($sql);
         $result->bindParam(':code', $code, PDO::PARAM_STR);
         $result->setFetchMode(PDO::FETCH_ASSOC);
         $result->execute();
         return $result->fetch();

     }*/
    public static function setActivatedAccount($code)
    {
        // Соединение с БД
        $db = Db::getConnection();
        $sql = "UPDATE users SET status='1' WHERE activation = :code";
        $result = $db->prepare($sql);
        $result->bindParam(':code', $code, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();
    }

    public static function checkStatus($login)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM users WHERE login = :login';
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->execute();
        $user = $result->fetch();

        if ($user['status'] == '1') {
            return true;
        }
        return false;
    }

}