<?php
$title = 'Регистрация';
include_once ROOT . '/views/layouts/header.php'; ?>

    <div class="signup">

        <div class="<?php if (isset($errors)) echo 'reg-errors'; ?>">

            <?php if (isset($errors)) foreach ($errors as $error): ?>
                <?= $error ?><br>
            <?php endforeach; ?>

        </div>

        <h1>Регистрация</h1>

        <div class="signup-inset">
            <form action="#" method="post">
                *Введите логин:<br>
                <input type="text" name="login" class="text-field" placeholder=""
                       value="<?php echo $login; ?>"/>
                <br>*Введите Имя: <br>
                <input type="text" name="name" class="text-field" placeholder="" value="<?php echo $name; ?>"/>
                <br>*Введите E-mail: <br>
                <input type="email" name="email" class="text-field" placeholder=""
                       value="<?php echo $email; ?>"/>
                <br>*Введите пароль: <br>
                <input type="password" name="pass1" class="text-field" placeholder="" value=""/>
                <br>*Повторите пароль: <br>
                <input type="password" name="pass2" class="text-field" placeholder="" value=""/>
                <br>Укажите пол: <br>
                <input type="radio" name="gender" value="none" class="signup-gender" checked>Не указан
                <input type="radio" name="gender" value="male" class="signup-gender">Мужской
                <input type="radio" name="gender" value="female" class="signup-gender">Женский
                <br><br>День рождения: <br>
                <input type="number" name="day" min="1" max="31">
                <select name="month">
                    <option value="01">Январь</option>
                    <option value="02">Февраль</option>
                    <option value="03">Март</option>
                    <option value="04">Апрель</option>
                    <option value="05">Май</option>
                    <option value="06">Июнь</option>
                    <option value="07">Июль</option>
                    <option value="08">Август</option>
                    <option value="09">Сентябрь</option>
                    <option value="10">Октябрь</option>
                    <option value="11">Ноябрь</option>
                    <option value="12">Декабрь</option>
                </select>
                <input type="number" name="year" min="1900" max="2016">
                <br>
                <br>
                <div class="g-recaptcha" data-sitekey="6LfMQzUUAAAAAFz1uGlvoCxDFeKvprPcXrii76CJ"></div>
                <input type="submit" name="submit" class="btn-global btn-submit " value="Регистрация"/>
            </form>
        </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?php include_once ROOT . '/views/layouts/footer.php'; ?>