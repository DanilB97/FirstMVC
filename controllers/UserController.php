<?php

//include_once ROOT . '/models/User.php';


class UserController
{
    /**
     * @return bool
     */
    public function actionRegister()
    {
        $login = '';
        $name = '';
        $email = '';

        if (isset($_POST['submit'])) {

            $login = $_POST['login'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            $gender = $_POST['gender'];

            //Проверка на заполнение полей даты рождения
            if ($_POST['month'] != '' && $_POST['day'] != '')
                $birth = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
            else $birth = null;
            //Проверка выбора пола
            if ($gender === 'none')
                $gender = null;

            $errors = false;

            //Проверка полей регистрации
            if (User::checkLogin($login))
                $errors['err_login'] = ' Логин должен состоять из более 3-ех символов.';
            if (User::checkLoginExists($login))
                $errors['err_login_exists'] = ' Данный логин уже существует!';
            if (!User::checkEmail($email))
                $errors['err_email'] = ' Неверно введен email!';
            if (User::checkEmailExists($email))
                $errors['err_email_exists'] = ' Данный email уже существует!';
            if (User::checkName($name))
                $errors['err_name'] = 'Имя должно быть заполнено.';
            if (!User::checkPassEquals($pass1, $pass2))
                $errors['err_pass_equals'] = ' Введенные пароли не совпадают.';
            if (User::checkPass($pass1))
                $errors['err_pass'] = ' Ваш пароль должен состоять из более 6-ти символов.';
            if (!User::checkCaptcha())
                $errors['err_captcha'] = ' Не пройдена Каптча.';

            if (!$errors) {
                User::register($login, $name, $email, $pass1, $birth, $gender);
                header('Location:http://second.loc/');
            }
        }

        include_once ROOT . '/views/user/register.php';
        return true;
    }

    /**
     * @return bool
     */
    public function actionLogin()
    {
        $login = false;
        $password = false;

        $error = false;

        if (isset($_POST['auth'])) {
            $login = $_POST['login'];
            $pass = $_POST['pass'];

            $userId = User::checkUser($login, $pass);

            if ($userId == false)
                $error = 'Неверный логин или пароль';
            else {
                User::auth($userId);
                header('Location:http://second.loc/');
            }

        }

        include_once ROOT . '/views/user/login.php';
        return true;
    }

    /**
     * @return bool
     */
    public function actionLogout()
    {
        unset($_SESSION['user']);
        session_destroy();
        header("Location: /");
        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function actionShow($id)
    {
        if ($id) {
            $user = User::getUserById($id);
            include_once ROOT . '/views/user/cabinet.php';
        }

        return true;
    }
}