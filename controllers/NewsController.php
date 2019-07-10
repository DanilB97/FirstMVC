<?php

include_once ROOT . '/models/News.php';

class NewsController
{

    /**
     * @param $page
     * @return bool
     */
    public function actionIndex($page)
    {
        $current_page = $page;
        //Определение количества страниц
        function pages()
        {
            $totalNews = News::countNews();
            $pages = ceil($totalNews / 10);
            return $pages;
        }

        //Исключение события, что страница будет отрицательной
        function checkPage($page)
        {
            if ($page <= 0) return 1;
            return $page;
        }

        $newsList = News::getNewsList($page);

        $userLvl = '';
        if (isset($_SESSION['user']))
            $userLvl = User::getUserLvlById($_SESSION['user']);

        //Проверка на наличие иконки новости. Если нету - берется картинка по умолчанию
        function img($newsItem)
        {
            if (file_exists(ROOT . '/template/images/' . $newsItem['id'] . '.png'))
                echo '/template/images/' . $newsItem['id'] . '.png';
            else echo '/template/images/no-logo.png';
        }


        require_once ROOT . '/views/news/index.php';
        return true;
    }

    /**
     * @param $news_id
     * @return bool
     */
    public function actionView($news_id)
    {
        if (isset($_POST['news-comment'])) {
            $user_login = User::getUserLoginById($_SESSION['user']);
            $comment_text = $_POST['text'];
            $user_id = $_SESSION['user'];

            News::addComment($news_id, $user_id, $user_login, $comment_text);
            header('Location:http://second.loc/news/' . $news_id);
        }

        if ($news_id) {
            $newsItem = News::getNewsItemById($news_id);
            $comments = News::getCommentsByNewsId($news_id);

            //Проверка на наличие иконки новости
            function img($newsItem)
            {
                if (file_exists(ROOT . '/template/images/' . $newsItem['id'] . '.png'))
                    echo '/template/images/' . $newsItem['id'] . '.png';
                else echo '/template/images/no-logo.png';
            }

            require_once ROOT . '/views/news/view.php';
            return true;
        }
    }

    /**
     * @return bool
     */
    public function actionCreate()
    {

        if (isset($_POST['add-news'])) {
            $title = $_POST['title'];
            $short_content = $_POST['short-content'];
            $content = $_POST['content'];
            $author_id = $_SESSION['user'];
            $author_login = User::getUserLoginById($_SESSION['user']);

            News::addNews($author_id, $title, $short_content, $content, $author_login);
            header('Location:http://second.loc/');
        }

        require_once ROOT . '/views/news/create.php';
        return true;
    }
}