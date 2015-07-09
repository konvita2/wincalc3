<html lang="ru">

<head>
    <title>WinCalc3 - оконный калькулятор</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/bootstrap.css"/>
    <link rel="stylesheet" href="/css/style.css"/>
    <script src="/js/jquery-2.1.4"></script>
    <script src="/js/bootstrap.js"></script>


</head>

<body>

<nav class="navbar navbar-fixed-top">
    <div class="container-fluid navplus">
        <a class="navbar-brand img_logo" href="#">
            <img src="/img/logo_red.png" height="20px"/>
        </a>
        <ul class="nav navbar-nav">
            <li><a href="#about">arka.ua</a></li>
            <li><a href="#contact">О программе</a></li>
        </ul>

        <form action="login_process.php" class="navbar-form navbar-right" method="post">
            <div class="form-group">
                <input name="login" type="text" placeholder="Логин" value="" class="form-control"/>
                <input name="password" type="password" placeholder="Пароль" value="" class="form-control"/>
                <button type="submit" class="btn btn-primary">
                    <i class="glyphicon glyphicon-log-in"></i> Вход
                </button>
            </div>
        </form>
    </div>
</nav>

<div class="container">

    <?
        $this->load->helper('url');
    ?>


    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Успешно выполнено</h3>
        </div>
        <div class="panel-body">
            <p><?=$textinfo?></p>
        </div>
    </div>

    <a class="btn btn-primary" href="<?=base_url().'index.php/conf_glass'?>">К списку стеклопакетов</a>


</div>

</body>
</html>
