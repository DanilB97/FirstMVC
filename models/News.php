<?php

class News
{

    /**
     * @param $id
     * @return mixed
     */
    public static function getNewsItemById($id)
    {
        $id = intval($id);

        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM `news` WHERE `id` = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_STR);

            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();
        }
    }

    /**
     * @param $page
     * @return array
     */
    public static function getNewsList($page)
    {
        $page -= 1;
        $newsList = array();

        $db = Db::getConnection();
        $sql = 'SELECT `id`, `author_id`, `title`, `date`, `author_login`, `short_content` FROM `news` ORDER BY id DESC LIMIT ' . $page * 10 . ', 10';

        $result = $db->query($sql);

        $i = 0;
        while ($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['author_id'] = $row['author_id'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['date'] = $row['date'];
            $newsList[$i]['author_login'] = $row['author_login'];
            $newsList[$i]['short_content'] = $row['short_content'];
            $i++;
        }

        return $newsList;
    }

    /**
     * @param $author_id
     * @param $title
     * @param $short_content
     * @param $content
     * @param $author_login
     */
    public static function addNews($author_id, $title, $short_content, $content, $author_login)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO `news` (`author_id`, `title`, `short_content`, `content`, `author_login`) VALUES (:author_id, :title, :short_content, :content, :author_login)';

        $result = $db->prepare($sql);
        $result->bindParam(':author_id', $author_id, PDO::PARAM_STR);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':short_content', $short_content, PDO::PARAM_STR);
        $result->bindParam(':content', $content, PDO::PARAM_STR);
        $result->bindParam(':author_login', $author_login, PDO::PARAM_STR);


        $result->execute();
    }

    /**
     * @param $news_id
     * @param $user_id
     * @param $user_login
     * @param $text
     */
    public static function addComment($news_id, $user_id, $user_login, $text)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO `news_comments` (`news_id`, `user_id`, `user_login`, `text`) VALUES (:news_id, :user_id, :user_login, :text)';

        $result = $db->prepare($sql);
        $result->bindParam(':news_id', $news_id, PDO::PARAM_STR);
        $result->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $result->bindParam(':user_login', $user_login, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);

        $result->execute();
    }

    /**
     * @param $news_id
     * @return array
     */
    public static function getCommentsByNewsId($news_id)
    {
        $comments = array();

        $db = Db::getConnection();
        $sql = 'SELECT * FROM `news_comments` WHERE `news_id` = :news_id';

        $result = $db->prepare($sql);
        $result->bindParam(':news_id', $news_id, PDO::PARAM_STR);

        $result->execute();

        $i = 0;
        while ($row = $result->fetch()) {
            $comments[$i]['user_id'] = $row['user_id'];
            $comments[$i]['user_login'] = $row['user_login'];
            $comments[$i]['text'] = $row['text'];
            $comments[$i]['date'] = $row['date'];
            $i++;
        }
        return $comments;
    }

    /**
     * @return mixed
     */
    public static function countNews()
    {
        $db = Db::getConnection();
        $sql = 'SELECT COUNT(*) FROM `news`';
        $result = $db->query($sql);

        $count = $result->fetch();

        return $count[0];
    }
}