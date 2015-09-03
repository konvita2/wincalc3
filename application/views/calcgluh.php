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
                            <i class="glyphicon glyphicon-log-in"></i>  Вход
                        </button>
                    </div>
                </form>
            </div>
        </nav>

        <div class="container">

            <h1>Расчет глухого окна</h1> 

            <?php if (!isset($_POST['btnPress'])): ?>

                <div class="calc">

                    <form action="calcgluh" method="post" class="kv-calc-form">
                        <div class="form-group">
                            <label for="winWidth">Ширина (мм)</label>
                            <input type="number" class="form-control" id="winWidth" 
                                   value="1000" name="winWidth"/>
                        </div>

                        <div class="form-group">
                            <label for="winHeight">Высота (мм)</label>
                            <input type="number" class="form-control" id="winHeight" 
                                   value="1200" name="winHeight"/>
                        </div>

                        <div class="form-group">
                            <label for="winSystem">Система</label>
                            <select class="form-control" id="winSystem" name="winSystem">
                                <option>Euro 60</option>
                                <option>Euro 70</option>                        
                            </select>                    
                        </div>

                        <div class="form-group">
                            <label for="winGlass">Укажите стеклопакет:</label>
                            <select class="form-control" id="winGlass" name="winGlass">
                                <option>4-16-4i</option>
                                <option>4-10-4-10-4i</option>
                                <option>4-10-4-10Arg-4i</option>
                                <option>4-16-4</option>
                                <option>4-16Arg-4i</option>
                                <option>Без заполнения</option>
                            </select>
                        </div>              

                        <button type="submit" class="btn btn-primary" name="btnPress">Рассчитать</button>
                    </form>
                </div>

            <?php else: ?>

            <div class="calc-result">
                
                <?php 
                    $winW = $_POST['winWidth'];
                    $winH = $_POST['winHeight'];
                    $winS = $_POST['winSystem'];
                    $winG = $_POST['winGlass'];
                                                
                ?>
                
                <h4>Заданное окно</h4>
                <p>                    
                    Размер: <?php echo "$winW x $winH"; ?>  <br/>
                    Система: <?php echo "$winS"; ?> <br/>
                    Стеклопакет: <?php echo "$winG"; ?> <br/>                    
                </p>
                
                <button class="btn btn-default" 
                        onclick="window.open('calcgluh');">
                    Новый просчет</button>
                
            </div>
            
                

            <?php endif ?>




        </div>

    </body>

</html>