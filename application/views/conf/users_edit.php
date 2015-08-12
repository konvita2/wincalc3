<?
// libraries
$this->load->helper('form');
$this->load->helper('url');
?>

<? $this->load->view('main_topmost'); ?>

<html lang="ru">

<?
$dt['tit'] = 'Пользователи редактор';
$this->load->view('main_head', $dt);
?>

<script type="text/javascript">

    function validatePassword(){
        // test passwords
        var p = $('#input_psw').val();
        var p1 = $('#input_psw1').val();
        if(p != p1){
            alert('Пароли не совпадают');
            return false;
        }
        return true;
    };

</script>

<body>

<?

/**
 * @todo
 * -
 */

?>

<? $this->load->view('main_navbar'); ?>

<div class="container">
    <h3>
        Пользователи:
        <? if($mode == 'ed'): ?>
            редактирование
        <? elseif($mode == 'dl'): ?>
            удаление
        <? elseif($mode == 'nw'): ?>
            добавление нового
        <? else: ?>
            неизвестная команда
        <? endif ?>
    </h3>

    <? if($mode == 'dl'): ?>
        <div class="alert alert-danger">
            Вы уверены в том, что хотите удалить выбранного пользователя?
        </div>
    <? endif ?>

    <!-- validation errors -->

    <?php
    // validation errors
    $estr = validation_errors();
    $evisi = !empty($estr) ? '' : 'style="display: none"';
    ?>

    <div class="alert alert-danger" role="alert" <?=$evisi?> > <? echo $estr; ?> </div>

    <!-- prepare form -->
    <?php

    //placeholders
    $ph_username = '';
    $ph_email = '';
    $ph_psw = '';
    $ph_company = '';
    $ph_phone = '';
    $ph_ln = '';
    $ph_fn = '';
    if($mode == 'nw'){
        $ph_username = "placeholder='Введите логин'";
        $ph_email = "placeholder='Введите email'";
        $ph_psw = "placeholder='Введите пароль'";
        $ph_company = "placeholder='Компания'";
        $ph_phone = "placeholder='Телефон'";
        $ph_ln = "placeholder='Фамилия пользователя'";
        $ph_fn = "placeholder='Имя пользователя'";
    }

    // readonly attribute for ed
    $ro_ed = '';
    if($mode == 'ed'){
        $ro_ed = 'readonly';
    }

    // readonlu attribute for dl
    $ro_dl = '';
    if($mode == 'dl'){
        $ro_dl = 'readonly';
    }

    ?>


    <!-- form_open  -->

    <?php
    $ar_nw = array('class' => 'form-horizontal','onsubmit' => 'return validatePassword();');
    if($mode == 'nw')       echo form_open("users/add", $ar_nw);

    $ar_ed = array('class' => 'form-horizontal');
    if($mode == 'ed')       echo form_open("users/edit/$id", $ar_ed);

    $ar_dl = array('class' => 'form-horizontal');
    if($mode == 'dl')       echo form_open("users/del/$id", $ar_dl);
    ?>

        <div class="form-group">
            <label for="input_username" class="control-label col-sm-2">Код</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" readonly
                       id="input_username" name="id" value="<?=$id?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="input_username" class="control-label col-sm-2">Логин (обязательно)</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" <?=$ph_username?> <?=$ro_ed?> <?=$ro_dl?>
                       id="input_username" name="username" value="<?=set_value('username',$username)?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="input_email" class="control-label col-sm-2">Email (обязательно)</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" <?=$ph_email?> <?=$ro_ed?> <?=$ro_dl?>
                       id="input_email" name="email" value="<? echo set_value('email',$email); ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="input_first_name" class="control-label col-sm-2">Имя</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" <?=$ph_fn?> <?=$ro_dl?>
                       id="input_first_name" name="first_name" value="<?=set_value('first_name',$first_name)?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="input_last_name" class="control-label col-sm-2">Фамилия</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" <?=$ph_ln?> <?=$ro_dl?>
                       id="input_last_name" name="last_name" value="<?=set_value('last_name',$last_name)?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="input_company" class="control-label col-sm-2">Компания</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" <?=$ph_company?> <?=$ro_dl?>
                       id="input_company" name="company" value="<?=set_value('company',$company)?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="input_phone" class="control-label col-sm-2">Телефон</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" <?=$ph_phone?> <?=$ro_dl?>
                       id="input_phone" name="phone" value="<?=set_value('phone',$phone)?>"/>
            </div>
        </div>

        <!-- плохо документировано пока не работает
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-3">
                <div class="checkbox">
                <label>
                    <input type="checkbox" name="active" value="1"/>Активен
                </label>
                </div>
            </div>
        </div>
        -->

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-3">
                <div class="checkbox">
                    <label>
                        <?

                        $ch_admin = '';
                        if($mode == 'ed' OR $mode == 'dl'){
                            $ch_admin = $admin == 1 ? 'checked' : '';
                        }

                        ?>
                        <input type="checkbox" name="admin" value="1" <?=$ch_admin?> <?=$ro_dl?>/>Административные права
                    </label>
                </div>
            </div>
        </div>

        <!-- passwords -->

        <? if($mode == 'nw'): ?>

            <div class="form-group">
                <label for="input_psw" class="control-label col-sm-2">Пароль (обязательно)</label>
                <div class="col-sm-2">
                    <input type="password" class="form-control" <?=$ph_psw?>
                           id="input_psw" name="password" value="<?=$password?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="input_psw1" class="control-label col-sm-2">Пароль еще раз (обязательно)</label>
                <div class="col-sm-2">
                    <input type="password" class="form-control" <?=$ph_psw?>
                           id="input_psw1" name="password1" value="<?=$password1?>"/>
                </div>
            </div>

        <? endif ?>

        <!-- buttons -->
        <div class="form-group">

            <div class="col-sm-offset-2">
                <button type="submit" class="btn btn-primary" name="btn_save" id="btn_save">
                    <? echo $mode == 'dl' ? 'Удалить' : 'Сохранить' ?>
                </button>

                <?
                $ar = array(
                    'type' => 'button',
                    'class' => 'btn btn-primary',
                    'name' => 'btn_cancel',
                );
                echo anchor('users/index', 'Отмена', $ar);
                ?>

            </div>
        </div>


    <!-- form_close -->
    <?php echo form_close(); ?>



</div>

</body>



</html>