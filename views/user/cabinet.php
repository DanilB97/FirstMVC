<?php $title = $user['login'];
include_once ROOT . '/views/layouts/header.php'; ?>

<div class="cabinet-container">
    <ul>
        <li class="user">
            <div class="avatar"><img src="" alt=""></div>
        </li>
        <li class="user">
            <pre>
                <?php print_r($user) ?>
            </pre>
        </li>
        <li class="user">

        </li>
    </ul>
</div>

<?php include_once ROOT . '/views/layouts/footer.php'; ?>
