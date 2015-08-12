<?
// libraries
$this->load->helper('form');
$this->load->helper('url');
?>

<? $this->load->view('main_topmost'); ?>

<html lang="ru">

<?
$dt['tit'] = 'Пользователь пароль';
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

    <h3>Установка пароля для пользователя <?=$username?></h3>

    <!-- form_open -->

    <?
    $ar = array('class' => 'form-horizontal','onsubmit' => 'return validatePassword();');
    echo form_open("users/psw/$id", $ar);
    ?>

    <div class="form-group">
        <label for="input_psw" class="control-label col-sm-2">Пароль </label>
        <div class="col-sm-2">
            <input type="password" class="form-control" placeholder="Введите пароль"
                   id="input_psw" name="password" value="<?=$password?>"/>
        </div>
    </div>

    <div class="form-group">
        <label for="input_psw1" class="control-label col-sm-2">Пароль еще раз</label>
        <div class="col-sm-2">
            <input type="password" class="form-control" placeholder="Введите пароль еще раз"
                   id="input_psw1" name="password1" value="<?=$password1?>"/>
        </div>
    </div>

    <!-- buttons -->
    <div class="form-group">
        <div class="col-sm-offset-2">
            <button type="submit" class="btn btn-primary" name="btn_save" id="btn_save">
                Сохранить
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
    <? echo form_close(); ?>

</div>

</body>
</html>