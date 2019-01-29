<?php

class UserController
{
    public function actionRegister()
    {
        $login = '';
        $email = '';
        $password = '';
        $password1 = '';
        $result = false;
        if (isset($_POST['submit'])) {
            $login = $_POST['login'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password1 = $_POST['password1'];
            $errors = false;

            $base_url = 'https://otp48.ru/emailactivation/';
            //$base_url='http://kbukova2.ffox.site/emailactivation/';
            $activation = md5($email . time());

            if (!User::checkName($login)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if (!User::checkСoincidencePassword($password, $password1)) {
                $errors[] = 'Неправильно введен пароль';
            }
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }
            if (User::checkEmailExists($email)) {
                $errors[] = 'Пользователь с таким e-mail адресом уже зарегистрирован';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            if (User::checkNameExists($login)) {
                $errors[] = 'Пользователь с таким именем уже зарегистрирован на сайте, пожалуйста выберите другое. ';
            }
            if ($errors == false) {
                //условие проверки капчи
                if (isset($_POST['g-recaptcha-response'])) {
                    $url_to_google_api = "https://www.google.com/recaptcha/api/siteverify";
                    $secret_key = '6Lduj4EUAAAAAFIs3GLgYkWgY39OVWA0NWigEaVo';
                    $query = $url_to_google_api . '?secret=' . $secret_key . '&response=' . $_POST['g-recaptcha-response'] . '&remoteip=' . $_SERVER['REMOTE_ADDR'];
                    $data = json_decode(file_get_contents($query));
                    if ($data->success) {
                        $password = User::generateHash($password);
                        if (!User::register($login, $email, $password, $activation)) {
                            $errors[] = 'Ошибка Базы Данных';
                        } else {
                            $title = 'Подтверждение электронной почты онлайнТП!';
                            $letter = 'Здравствуйте! <br/> <br/> Мы должны убедиться в том, что вы человек. Пожалуйста, подтвердите адрес вашей электронной почты, и можете начать использовать ваш аккаунт на сайте. <br/> <br/> <a href="' . $base_url . 'activation/' . $activation . '">' . $base_url . 'activation/' . $activation . '</a>';


                            $body = '
                        <head>
                        <title>Подтверждение электронной почты онлайнТП!</title>
                        </head>
                        <body>
                       
                        
                        <h2>Здравствуйте!</h2>
                        <p>Мы должны убедиться в том, что вы человек. Пожалуйста, подтвердите адрес вашей электронной почты, и можете начать использовать ваш аккаунт на сайте. <br/> <br/> <a href="' . $base_url . 'activation/' . $activation . '">' . $base_url . 'activation/' . $activation . '</a></p>
                        
                        <p>С Уважением,<br />
                      ОГУП Липецкоблводоканал</p>
                      </body>';


                            require_once(ROOT . '/lib/phpmailer/PHPMailerAutoload.php');
                            require_once(ROOT . '/lib/phpmailer/class.phpmailer.php');
                            $mail = new PHPMailer;
                            $mail->IsMail();
                            $mail->CharSet = 'UTF-8';
                            $mail->setFrom('otp@otp48.ru', 'otp');
                            $mail->FromName = 'ОГУП "Липецкоблводоканал"';
                            $mail->addAddress($email, 'User');
                            $mail->addAddress('ellen@example.com');
                            $mail->addReplyTo('info@example.com', 'Information');
                            $mail->addCC('cc@example.com');
                            $mail->addBCC('bcc@example.com');
                            $mail->addAttachment('');
                            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');
                            $mail->isHTML(true);
                            $mail->Subject = $title;
                            $mail->Body = $body;
                            $mail->AltBody = $letter;
                            if (!$mail->send()) {
                                echo 'Message could not be sent.';
                                echo 'Mailer Error: ' . $mail->ErrorInfo;
                            } else {
                                header("Location:/user/regok/");


                            }
                            // header("Location:/user/regok/");
                            // echo 'Регистрация прошла успешно';
                        }
                    } else {
                        exit('Извините но похоже вы робот \(0_0)/');
                    }
                } else {
                    exit('Вы не прошли валидацию reCaptcha');
                }
            }
        }
        require_once(ROOT . '/views/user/register.php');
        return true;
    }


    public function verify($password, $hashedPassword)
    {
        return crypt($password, $hashedPassword) == $hashedPassword;
    }


    public function actionLogin()
    {
        $login = '';
        $password = '';
        if (isset($_POST['submit'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $errors = false;
            if (!User::checkName($login)) {
                $errors[] = 'Неккоректное имя';
            }

            if (!User::checkStatus($login)) {
                $errors[] = 'Аккаунт не активирован';
            }

            $userId = User::checkUserData($login, $password);
            if ($userId == false) {
                $errors[] = 'Неправильные имя или пароль или все вместе';
            }
            $check = User::checkUserDataHash($login);

            $hashed_password = $check['password'];
            $userId = $check['user_id'];

            if ($this->verify($password, $hashed_password)) {
                if (User::checkStatus($login)) {
                    User::auth($userId);
                    if ($check['role'] == "Admin") {
                        header("Location: /admin/");
                    } else {
                        header("Location: /cabinet/");
                    }
                }
            } else $errors[] = 'Неправильные данные для входа на сайт';
        }
        require_once(ROOT . '/views/user/login.php');
        return true;
    }


    public function actionLogout()
    {
        unset($_SESSION["user"]);
        header("Location: /");
    }

    public function actionRestorePass()
    {
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            if (empty($email)) {
                echo "Введите e-mail!";
            } else {
                $result = User::getUserByEmail($email);
                if (empty($result)) {
                    echo 'Ошибка! Такого пользователя не существует';
                } elseif (count($result) > 0) {
                    $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
                    $max = 10;
                    $size = StrLen($chars) - 1;
                    $password = null;
                    while ($max--) {
                        $password .= $chars[rand(0, $size)];
                    }
                    $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
                    $newmdPassword = crypt($password, $salt);
                    $title = 'Востановления пароля пользователю, зарегистрированного по адресу электронной почты ' . $email . ' для личного кабинета онлайнТП!';
                    $letter = 'Вы запросили восстановление пароля для аккаунта зарегистрированного по адресу электронной почты ' . $email . ' на сайте личного кабинета онлайнТП. Ваш новый пароль: ' . $password . ' . C уважением администрация сайта личного кабинета онлайнТП';
                    require_once(ROOT . '/lib/phpmailer/PHPMailerAutoload.php');
                    require_once(ROOT . '/lib/phpmailer/class.phpmailer.php');
                    $mail = new PHPMailer;
                    $mail->IsMail();
                    $mail->CharSet = 'UTF-8';
                    $mail->setFrom('otp@otp48.ru', 'otp');
                    $mail->FromName = 'ОГУП "Липецкоблводоканал"';
                    $mail->addAddress($email, 'User');
                    $mail->addAddress('ellen@example.com');
                    $mail->addReplyTo('info@example.com', 'Information');
                    $mail->addCC('cc@example.com');
                    $mail->addBCC('bcc@example.com');
                    $mail->addAttachment('');
                    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');
                    $mail->isHTML(true);
                    $mail->Subject = $title;
                    $mail->Body = $letter;
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    if (!$mail->send()) {
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                        $update = User::setRecoveryHashPassword($email, $newmdPassword);
                        echo 'Сообщение с новым паролем было отправлено Вам на E-mail.';
                    }
                    /*  $from='katia@kbukova.ffox.site';
                     if( mail($email, $title, $letter, 'from:'.$from, '-f'.$from)){
                          $update = User::setRecoveryHashPassword($email,$newmdPassword);
                         echo 'Новый пароль отправлен на ваш e-mail!<br><a href="/">Главная страница</a>';
                     }else{echo 'NO';}*/
                }
            }
        }
        require_once(ROOT . '/views/user/restore.php');
        return true;
    }


    public function actionRegOk()
    {


        require_once(ROOT . '/views/user/regok.php');
        return true;
    }

    public function actionRegOk1()
    {
        $url = $_SERVER["REQUEST_URI"];
        $modurl = explode("/", $url);
        $msg = '';
        if (isset($modurl[3])) {
            $code = ($modurl[3]);

            User::setActivatedAccount($code);
            $msg = "Ваш аккаунт активирован";

        }

        require_once(ROOT . '/views/user/regok2.php');
        return true;
    }


}