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
        
        <div class="calc">
            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input type="file" id="exampleInputFile">
                    <p class="help-block">Example block-level help text here.</p>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Check me out
                    </label>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form></div>
        
        
    </div>
    
</body>

</html>