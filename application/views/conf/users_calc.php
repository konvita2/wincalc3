<?
// libraries
$this->load->helper('form');
$this->load->helper('url');
?>

<? $this->load->view('main_topmost'); ?>

<html lang="ru">

<?
$dt['tit'] = 'Пользователи показатели калькуляции';
$this->load->view('main_head', $dt);
?>

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
        Показатели калькуляции
        <em><?=$username?></em>
    </h3>

    <?php
    // validation errors
    $estr = validation_errors();
    $evisi = !empty($estr) ? '' : 'style="display: none"';
    ?>

    <div class="alert alert-danger" role="alert" <?=$evisi?> > <? echo $estr; ?> </div>

    <!-- form open -->    
    <?
    $ar = array('class' => 'form-horizontal');
    echo form_open("users/calcedit/$user_id", $ar);
    ?>

    <div class="form-group">
        <label for="mater" class="control-label col-sm-4">Накладные расходы материалов, %</label>
        <div class="col-sm-2">
            <input type="text" class="form-control"
                   id="mater" name="mater" value="<?=$mater?>"/>
        </div>
    </div>

    <div class="form-group">
        <label for="prod" class="control-label col-sm-4">Накладные расходы производства, %</label>
        <div class="col-sm-2">
            <input type="text" class="form-control"
                   id="prod" name="prod" value="<?=$prod?>"/>
        </div>
    </div>

    <div class="form-group">
        <label for="marg" class="control-label col-sm-4">Наценка, %</label>
        <div class="col-sm-2">
            <input type="text" class="form-control"
                   id="marg" name="marg" value="<?=$marg?>"/>
        </div>
    </div>


    <!-- buttons -->
    <div class="form-group">

        <div class="col-sm-offset-4">
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






    <!-- form close -->
    <? echo form_close(); ?>    

</div>

</body>
</html>
