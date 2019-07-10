<?php $title = 'Добавить новость';
require_once ROOT . '/views/layouts/header.php'; ?>

<div class="create-news-container">
    <form action="#" method="post">
        Лого:
        <input type="file" name="" class="btn-global">
        Заголовок:
        <input type="text" name="title" class="text-field news-field news-field-title">
        <br>Краткое описание:<br>
        <pre><textarea type="text" name="short-content" class="text-field news-field news-field-short-content"></textarea></pre>
        <br>Содержание:<br>
        <textarea type="text" name="content" class="text-field news-field news-field-content"></textarea>

        <br><input type="submit" name="add-news" class="btn-global">
    </form>

</div>

<?php require_once ROOT . '/views/layouts/footer.php'; ?>
