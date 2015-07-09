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

    <h3>Список используемых стеклопакетов</h3>

    <a class="btn btn-primary" href="conf_glass/add">Добавить стеклопакет</a>

    <table class="table">

        <thead>
        <tr>
            <td>Код</td>
            <td>Наименование</td>
            <td>Описание</td>
            <td>Вал</td>
            <td>Цена за 1 кв.м</td>
            <td>Действия</td>
        </tr>
        </thead>

        <tbody>

        <? foreach($glasses as $glass): ?>

            <tr>
                <td><?=$glass['id']?></td>
                <td><?=$glass['nam']?></td>
                <td><?=$glass['description']?></td>

                <td><?=$glass['cur_name']?></td>
                <td><?=$glass['price']?></td>

                <td>
                    <a class="btn btn-primary" href="conf_glass/edit/<?=$glass['id']?>">
                        <span class="glyphicon glyphicon-pencil" href="conf_glass/edit/<?=$glass['id']?>"></span>
                    </a>

                    <a class="btn btn-primary" type="button" href="conf_glass/del/<?=$glass['id']?>">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </td>

            </tr>

        <? endforeach  ?>

        </tbody>

    </table>


    <p>

        <?



        ?>

    </p>
    <?




    ?>



</div>
</body>
</html>

