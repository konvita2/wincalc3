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