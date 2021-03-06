<?php $this->load->helper('form'); ?>


<nav class="navbar navbar-fixed-top">
    <div class="container-fluid navplus">
        <a class="navbar-brand img_logo" href="#">
            <img src="/img/logo_red.png" height="20px"/>
        </a>
        <ul class="nav navbar-nav">
            <li><a href="#about">arka.ua</a></li>
            <li><a href="#contact">О программе</a></li>

            <?php

            if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
                echo "<li>" . anchor('admin/index','Административный раздел') . "</li>";
            }

            ?>

        </ul>

        <?php if($this->ion_auth->logged_in()): ?>
            <?php  $ar = array('class' => "btn btn-default navbar-btn navbar-right", 'style' => 'margin-right: 4px;');
                $usr = $this->ion_auth->user()->row();
                $usr = $usr->username;
                echo  anchor('admin/logout', 'Выход ' . $usr , $ar);
            ?>
        <?php else: ?>
            <?php $ar = array('class' => 'navbar-form navbar-right'); ?>
            <?php echo form_open('admin/login', $ar); ?>

                <div class="form-group">
                    <input name="login" type="text" placeholder="Логин" value="" class="form-control"/>
                    <input name="password" type="password" placeholder="Пароль" value="" class="form-control"/>
                    <button type="submit" class="btn btn-primary">
                        <i class="glyphicon glyphicon-log-in"></i> Вход
                    </button>
                </div>
            <?php echo form_close(); ?>
        <?php endif ?>

    </div>
</nav>