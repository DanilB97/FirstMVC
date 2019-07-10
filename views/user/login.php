<?php
$title = 'Авторизация';
include_once ROOT . '/views/layouts/header.php'; ?>

<div class="signup signin">

    <div class="<?php if ($error) echo 'reg-errors'; ?>">
        <?= $error ?>
    </div>

    <div class="signup-inset signin-inset">


        <form action="#" method="post">
            Логин:
            <input type="text" name="login" class="text-field">
            Пароль:
            <input type="password" name="pass" class="text-field">

            <input type="submit" name="auth" class="btn-global btn-submit " value="Войти">

        </form>
    </div>

</div>
<?php include_once ROOT . '/views/layouts/footer.php'; ?>


