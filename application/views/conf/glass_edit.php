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

    <h3>
        Стеклопакеты:
        <? if($mode == 'ed'): ?>
            редактирование
        <? elseif($mode == 'dl'): ?>
            удаление
        <? elseif($mode == 'nw'): ?>
            добавление
        <? else: ?>
            неизвестная команда
        <? endif ?>
    </h3>

    <?

    // test cmd
    if($mode == 'ed' || $mode == 'dl' || $mode == 'nw'){
        $cmdOk = true;
    }
    else{
        $cmdOk = false;
    }

    // test data
    $dataOk = true;
    if($mode == 'ed' || $mode == 'dl'){
        if(empty($glass)){
            $dataOk = false;
        }
    }

    ?>

    <? if($cmdOk && $dataOk): ?>

        <!--
        <form class="form-horizontal">
        -->

        <?
            if($mode == 'ed' || $mode == 'dl'){
                $this->load->helper('form');
                $ar = array('class' => 'form-horizontal',);
                $id = $glass['id'];
                echo form_open("conf_glass/edit/$id",$ar);
            }
            elseif($mode == 'nw'){
                $this->load->helper('form');
                $ar = array('class' => 'form-horizontal',);
                $id = 0;
                $glass = array(
                    'id' => 0,
                    'nam' => '',
                    'description' => '',
                    'cur_name' => '',
                    'price' => 0,
                );
                echo form_open("conf_glass/new",$ar);
            }

        ?>

            <div class="form-group">
                <label for="inputId" class="col-sm-2 control-label">Код</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="inputId" readonly
                           value="<?=$glass['id']?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="inputNam" class="col-sm-2 control-label">Наименование</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="inputNam" name="nam"
                        value="<?=$glass['nam']?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="inputDesc" class="col-sm-2 control-label">Описание</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputDesc" name="description"
                           value="<?=$glass['description']?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="inputCurr" class="col-sm-2 control-label">Валюта</label>
                <div class="col-sm-2" >
                    <select class="form-control" name="cur_name">
                        <?=$currency_list?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPrice" class="col-sm-2 control-label">Цена в валюте за кв.м.</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="inputPrice" name="price"
                           value="<?=$glass['price']?>"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" name="btnSave">Сохранить</button>
                    <button type="button" class="btn btn-primary" name="btnCancel">Отмена</button>
                </div>
            </div>
        </form>

    <? else: ?>

        <!-- error messages -->

    <? endif ?>




</div>
</body>
</html>