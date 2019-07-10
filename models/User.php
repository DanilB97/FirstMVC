<?php

class User
{
    /**
     * @param $login
     * @param $name
     * @param $email
     * @param $pass
     * @param $birth
     * @param $gender
     */
    public static function register($login, $name, $email, $pass, $birth, $gender)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO `users` (`login`, `name`, `email`, `pass`, `birth`, `gender`) VALUES (:login, :name, :email, :pass, :birth, :gender)';

        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':pass', $pass, PDO::PARAM_STR);
        $result->bindParam(':birth', $birth, PDO::PARAM_STR);
        $result->bindParam(':gender', $gender, PDO::PARAM_STR);
        $result->execute();
    }

    /**
     * @param $login
     * @param $pass
     * @return bool
     */
    public static function checkUser($login, $pass)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM `users` WHERE `login` = :login AND `pass` = :pass';

        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':pass', $pass, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();

        if ($user)
            return $user['id'];
        return false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getUserById($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM `users` WHERE `id` = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getUserLoginById($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT `login` FROM `users` WHERE `id` = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->execute();

        return $result->fetch()[0];
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getUserLvlById($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT `level` FROM `users` WHERE `id` = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->execute();

        return $result->fetch()[0];
    }

    /**
     * @param $userId
     */
    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    /**
     * @return bool
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user']))
            return false;
        return true;
    }

    /**
     * @param $login
     * @return bool
     */
    public static function checkLogin($login)
    {
        if (strlen($login) < 3)
            return true;
        return false;
    }

    /**
     * @param $login
     * @return bool
     */
    public static function checkLoginExists($login)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM `users` WHERE `login` = :login';

        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn())
            return true;
        return false;
    }

    /**
     * @param $name
     * @return bool
     */
    public static function checkName($name)
    {
        if (strlen($name) < 1)
            return true;
        return false;
    }

    /**
     * @param $email
     * @return bool
     */
    public static function checkEmail($email)
    {

        if (filter_var($email, FILTER_VALIDATE_EMAIL))
            return true;
        return false;
    }

    /**
     * @param $email
     * @return bool
     */
    public static function checkEmailExists($email)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM `users` WHERE `email` = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn())
            return true;
        return false;
    }

    /**
     * @param $pass
     * @return bool
     */
    public static function checkPass($pass)
    {
        if (strlen($pass) < 6)
            return true;
        return false;
    }

    /**
     * @param $pass1
     * @param $pass2
     * @return bool
     */
    public static function checkPassEquals($pass1, $pass2)
    {
        if ($pass1 === $pass2)
            return true;
        return false;
    }

    /**
     * @return mixed
     */
    public static function checkCaptcha()
    {
        //Каптча
        $secretKey = '6LfMQzUUAAAAAECldrdlBXapOxPxrtm-ZBM0iyvj';
        $responseKey = $_POST['g-recaptcha-response'];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey";
        $response = json_decode(file_get_contents($url));

        return $response->success;
    }

}