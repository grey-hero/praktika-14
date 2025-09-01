<?php 
require_once 'functions.php'; 

session_start();
if($_GET['logout']==1){
    $_SESSION['login'] = '';
    $_SESSION['auth'] = false; 
}
if($_GET['cleardate']==1){
    $_SESSION['dateb'] = '';
}else{    
    if (isset($_POST['birthday'])) {
        $_SESSION['dateb'] = $_POST['birthday'];
    }
}
$auth = $_SESSION['auth'] ?? false;
$date = $_SESSION['dateb'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Демо-версия сайта для SPA-салона</title>

    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
    <header>
        <h1>Демо-версия сайта для SPA-салона <br>

            <?php if ($auth){
                ?>
                Добрый день, <?=$_SESSION['login']?>
                <?
            }?></h1>
        </header>
        <nav>
            <ul>
                <li><a href="#services">Услуги</a></li>
                <li><a href="#promotions">Акции</a></li>
                <li><a href="#gallery">Галерея</a></li>
                <li><a href="#contacts">Контакты</a></li>
            </ul>
        </nav>
        <nav>
            <ul>
                <?php if ($auth){
                    ?>
                    <li><a href="?logout=1">Выйти</a></li>
                    <?
                }else{
                    ?>
                    <li><a href="login.php">Войти</a></li>
                    <?
                } ?>
            </ul>
        </nav>
        <?php if ($auth){
            if ($date == '') {
                ?>
                <nav class="dateb">
                    Укажите дату рождения
                    <form action="index.php" method="post" сlass='dateform'>
                        <input type="date" name="birthday">
                        <input name="submit" type="submit" value="Подтвердить">
                    </form>
                </nav>
                <?
            }else{
                ?>
                <nav class="dateb">
                    <?
                    $birthday = $date;
                    $today = new DateTime();
                    $nextBirthday = new DateTime($birthday);

                    $currentYear = (int)$today->format('Y');
                    $nextBirthday->setDate($currentYear, $nextBirthday->format('m'), $nextBirthday->format('d'));

                    if ($today->format('Y-m-d') === $nextBirthday->format('Y-m-d')) {
                        echo "Сегодня день рождения!";
                    } elseif ($today > $nextBirthday) {
                        $nextBirthday->modify('+1 year');
                        $daysLeft = $today->diff($nextBirthday)->days;
                        echo "До дня рождения осталось: " . $daysLeft . " д.";
                    } else {
                        $daysLeft = $today->diff($nextBirthday)->days;
                        echo "До дня рождения осталось: " . $daysLeft . " д.";
                    }
                    ?>
                    <a href="?cleardate=1">Очистить дату</a>
                </nav>
                <?
            }
            ?>
            <nav class="dateb">
                <?
                $logindate = new DateTime($_SESSION['logindate']);
                $nextDay = clone $logindate;
                $nextDay->modify('+1 day');
                $currentDate = new DateTime();

                if($currentDate<$nextDay){
                    $interval = $currentDate->diff($nextDay);
                    echo $interval->format('до конца акции с последнего входа осталось %h ч. %i м. %s с.');
                }
                ?>
            </nav>
            <?
        }?>

        <section class="section" id="services">
            <h2 class="section-title">Наши услуги</h2>
            <div class="services">
                <div class="service-card">
                    <div class="service-img">
                        <img src="images/usl1.jpg" alt="Стрижка">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Стрижка</h3>
                        <p class="service-price">от 1500 руб.</p>
                        <p>Профессиональная стрижка с учетом особенностей вашего типа волос и формы лица.</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-img">
                        <img src="images/usl2.jpg" alt="Маникюр">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Маникюр</h3>
                        <p class="service-price">от 2000 руб.</p>
                        <p>Аппаратный, комбинированный или классический маникюр с покрытием.</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-img">
                        <img src="images/usl3.jpg" alt="Макияж">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Макияж</h3>
                        <p class="service-price">от 2500 руб.</p>
                        <p>Дневной, вечерний или свадебный макияж от профессионального визажиста.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section promotions" id="promotions">
            <h2 class="section-title">Акции и спецпредложения</h2>
            <div class="promotion-cards">
                <div class="promotion-card">
                    <div class="promotion-img">
                        <img src="images/akc1.jpg" alt="Акция 1">
                    </div>
                    <div class="promotion-content">
                        <h3 class="promotion-title">Скидка 20% на первое посещение</h3>
                        <p class="promotion-date">Действует до 30.11.2023</p>
                        <p>Для новых клиентов - скидка 20% на любую услугу при первом посещении нашего салона.</p>
                        <a href="#contacts" class="btn" style="margin-top: auto; align-self: flex-start;">Записаться</a>
                    </div>
                </div>

                <div class="promotion-card">
                    <div class="promotion-img">
                        <img src="images/akc2.jpg" alt="Акция 2">
                    </div>
                    <div class="promotion-content">
                        <h3 class="promotion-title">Комплекс "Все включено"</h3>
                        <p class="promotion-date">Действует до 15.12.2023</p>
                        <p>Стрижка, маникюр и макияж всего за 5000 руб. вместо 6500 руб.</p>
                        <a href="#contacts" class="btn" style="margin-top: auto; align-self: flex-start;">Записаться</a>
                    </div>
                </div>

                <div class="promotion-card">
                    <div class="promotion-img">
                        <img src="images/akc3.jpg" alt="Акция 3">
                    </div>
                    <div class="promotion-content">
                        <h3 class="promotion-title">Подарочный сертификат</h3>
                        <p class="promotion-date">Без ограничений</p>
                        <p>Подарите красоту своим близким! Сертификат на любую сумму с дополнительным бонусом +10%.</p>
                        <a href="#contacts" class="btn" style="margin-top: auto; align-self: flex-start;">Заказать</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="gallery">
            <h2 class="section-title">Наши работы</h2>
            <div class="gallery">
                <div class="gallery-item">
                    <img src="images/rab1.jpg" alt="Работа 1">
                </div>
                <div class="gallery-item">
                    <img src="images/rab2.jpg" alt="Работа 2">
                </div>
                <div class="gallery-item">
                    <img src="images/rab3.jpg" alt="Работа 3">
                </div>
                <div class="gallery-item">
                    <img src="images/rab4.jpg" alt="Работа 4">
                </div>
            </div>
        </section>

        <footer id="contacts">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Контакты</h3>
                    <p>Адрес</p>
                    <p>Телефон: <a href="tel:+7 (123) 456-78-90">+7 (123) 456-78-90</a></p>
                    <p>Email: <a href="mailto:info@spa.ru">info@spa.ru</a></p>
                </div>

                <div class="footer-section">
                    <h3>Часы работы</h3>
                    <p>Пн-Пт: 9:00 - 21:00</p>
                    <p>Сб-Вс: 10:00 - 20:00</p>
                </div>

                <div class="footer-section">
                    <h3>Мы в соцсетях</h3>
                    <div class="socials">
                        <a href="#">vk</a>
                        <a href="#">telegram</a>
                        <a href="#">whatsapp</a>
                    </div>
                </div>
            </div>

            <div class="copyright">
                <p>Демо-версия сайта для SPA-салона</p>
            </div>
        </footer>
    </body>
    </html>