<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title . ' - Awesome'; ?></title>

    <!-- SHORTCUT ICON -->
    <link rel="shortcut icon" href="/template/images/shortcut-icon.png" type="image/x-icon">

    <!-- MAIN CSS STYLE -->
    <link rel="stylesheet" href="/template/css/style.css">

    <!-- AWESOME FONTS -->
    <link rel="stylesheet" href="/template/includes/font-awesome-4.7.0/css/font-awesome.min.css">

</head>
<body>

<div class="header">
    <div class="header-logo">
        <a href="/"><img class="head-logo" src="/template/images/head-logo.png" alt="Error"></a>
        <a class="logo-text" href="/">Awesome</a>
    </div>
    <!--    <ul class="top-menu">-->
    <!--        <li class="header-top-menu"><a href="/news">Новости</a></li>-->
    <!--        <li class="header-top-menu"><a href="#">Статьи</a></li>-->
    <!--        <li class="header-top-menu"><a href="#">Файлы</a></li>-->
    <!--        <li class="header-top-menu"><a href="#">Форум</a></li>-->
    <!--    </ul>-->
    <div class="auth">
        <?php if (User::isGuest()): ?>
            <a href="/login">
                <div onclick="btn-login" class="btn-global btn-sign-in">Войти</div>
            </a>
            <a href="/register">
                <div onclick="btn-register" class="btn-global btn-sign-in">Регистрация</div>
            </a>
        <?php else: ?>
            <img src="" alt="">
            <a href="/user/<?= $_SESSION['user'] ?>"
               class="btn-global btn-sign-in"><?php echo User::getUserById($_SESSION['user'])['name']; ?></a>
            <a href="/logout" class="btn-global btn-logout btn-sign-in"><i class="fa fa-sign-out" aria-hidden="true"
                                                                           onclick=""></i></a>
        <?php endif; ?>
    </div>
</div>
<div class="header-menu">


</div>

<div class="social-menu">
    <a href="http://vk.com" class="social-link vk" target="_blank"><i class="fa fa-vk" aria-hidden="true"></i></a>
    <a href="http://twitter.com" class="social-link twitter" target="_blank"><i class="fa fa-twitter"
                                                                                aria-hidden="true"></i></a>
    <a href="http://facebook.com" class="social-link fb" target="_blank"><i class="fa fa-facebook"
                                                                            aria-hidden="true"></i></a>
    <a href="http://twitch.com" class="social-link twitch" target="_blank"><i class="fa fa-twitch"
                                                                              aria-hidden="true"></i></a>
    <a href="http://ok.ru" class="social-link ok" target="_blank"><i class="fa fa-odnoklassniki "
                                                                     aria-hidden="true"></i></a>
</div>