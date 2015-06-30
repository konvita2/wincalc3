<!DOCTYPE html>
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
        
        <div class="win-header">
            <h1>Оконный калькулятор</h1>            
        </div>       
        
        <div class="row">
            <div class="col-sm-6 win-grid">
                <div class="row">
                    
                    <div class="col-sm-4 win-img">
                        <img src="/img/okn_stvorka1.jpg" height="150px"/>
                    </div>
                    
                    <div class="col-sm-8">
                        <h4>Окно 1 створка</h4>
                        <p class="win-desc">
                        Наши окна это современные и очень удобные светопрозрачные 
                        системы, которые сохраняют тепло помещения в холодное время 
                        года или позволяют выбрать оптимальный режим проветривания 
                        в жаркую погоду. Они неприхотливы в уходе и на долгие годы 
                        сохраняют свой опрятный вид. Установка пластиковых окон 
                        принесет уют в Ваш дом и комфорт в Ваш офис.</p>                        
                        
                        <div><button type="button" class="btn btn-primary">Расчет</button></div>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-sm-6 win-grid">
                <div class="row">
                    
                    <div class="col-sm-4 win-img">
                        <img src="/img/okn_gluh.jpg" height="150px"/>
                    </div>
                    
                    <div class="col-sm-8">
                        <h4>Окно глухое</h4>
                        <p class="win-desc">
                        Наши окна это современные и очень удобные светопрозрачные 
                        системы, которые сохраняют тепло помещения в холодное время 
                        года или позволяют выбрать оптимальный режим проветривания 
                        в жаркую погоду. Они неприхотливы в уходе и на долгие годы 
                        сохраняют свой опрятный вид. Установка пластиковых окон 
                        принесет уют в Ваш дом и комфорт в Ваш офис.</p>                        
                        
                        <div><button type="button" class="btn btn-primary">Расчет</button></div>
                    </div>
                    
                </div>
                
            </div>
        </div>
        
        <div class="row">
            
        </div>
        
        
        
    </div>
    
    

</body>
    
    
    
</html>
