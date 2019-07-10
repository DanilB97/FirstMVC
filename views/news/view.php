<?php $title = $newsItem['title'];
include_once ROOT . '/views/layouts/header.php'; ?>

    <div class="container">

        <div class="container-inset">
            <!-- Основная часть -->
            <!-- Новости -->


            <div class="news">
                <div class="left-box"><a href="/news/<?= $newsItem['id'] ?>">
                        <img src="<?= img($newsItem) ?>"
                             alt="Not Found"></a>
                </div>
                <div class="right-box">
                    <div class="news-title"><a href="/news/<?= $newsItem['id'] ?>"> <?= $newsItem['title'] ?> </a>
                    </div>
                    <div class="news-text"><p> <?= $newsItem['short_content'] ?></p> </div>
                    <div class="news-bottom">
                        <div class="news-author">
                            <a href="/user/<?= $newsItem['author_id'] ?>"><?= $newsItem['author_login'] ?></a>
                        </div>
                        <div class="news-date"><?= $newsItem['date'] ?></div>
                    </div>
                </div>
            </div>

            <div class="news-content">
                <?= $newsItem['content'] ?>
            </div>

            <div class="comments">
                <h4 style="text-align: right; margin-right: 15px">Комментарии:</h4>
                <?php foreach ($comments as $comment): ?>
                    <div class="comments-inset">
                        <div class="user-comment">
                            <div class="upper-side">
                                <a href="/user/<?= $comment['user_id'] ?>"
                                   class="user-comment-login"><?= $comment['user_login'] ?></a>
                                <div class="user-comment-data"><?= $comment['date'] ?></div>
                            </div>
                            <div class="bottom-side">
                                <?= $comment['text'] ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php if (User::isGuest()): ?>
                    <h4 class="reg-errors" style="width: 80%; text-align: center">Чтобы оставить комментарий, вы
                        должны быть авторизованны.</h4>
                <?php else: ?>
                    <form action="#" method="post">
                        <textarea type="text" name="text" class="text-field comment-text" style="resize: vertical"> </textarea>
                        <input style="display: block; margin: 10px auto" type="submit" name="news-comment"
                               class="btn-global" value="Написать">
                    </form>
                <?php endif; ?>
            </div>


        </div>
    </div>

<?php include_once ROOT . '/views/layouts/footer.php'; ?>