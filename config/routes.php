<?php
return array(
    //Новости
    'news/page/([0-9]+)' => 'news/index/$1',
    'news/create' => 'news/create',
    'news/([0-9]+)' => 'news/view/$1',
    'news' => 'news/index/1',
    //Пользователь
    'register' => 'user/register',
    'login' => 'user/login',
    'logout' => 'user/logout',
    'user/([0-9]+)' => 'user/show/$1',

    //Главная страница
    '' => 'news/index/1',
);