<?php
$title = 'Новости';
include_once ROOT . '/views/layouts/header.php'; ?>


    <div class="container">

        <div class="container-inset">
            <!-- Основная часть -->
            <!-- Новости -->

            <?php if ($userLvl !== 'user' && !User::isGuest()): ?>
                <a href="/news/create" class="btn-global btn-create-news"> Добавить новость </a>
            <?php endif; ?>

            <?php foreach ($newsList as $newsItem): ?>

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

            <?php endforeach; ?>

        </div>

        <ul class="page-nav">
            <li><a class="btn-global page-switch" href="/news/page/1"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></li>

            <?php for ($curr = $current_page, $i = checkPage($curr - 3); $i < $curr; $i++): ?>
                <li><a class="btn-global" href="/news/page/<?= $i ?>"><?= $i ?></a></li>
            <?php endfor; ?>
            <?php if ($curr = $current_page): ?>
                <li><a class="btn-global btn-global-active" href="/news/page/<?= $curr ?>"><?= $curr ?></a></li>
            <?php endif; ?>
            <?php for ($curr = $current_page, $i = $curr + 1, $pages = pages(); $i <= $curr + 3 && $i <= $pages; $i++): ?>
                <li><a class="btn-global" href="/news/page/<?= $i ?>"><?= $i ?></a></li>
            <?php endfor; ?>
            <li><a class="btn-global page-switch" href="/news/page/<?= pages() ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>

        </ul>
    </div>

<?php include_once ROOT . '/views/layouts/footer.php'; ?>