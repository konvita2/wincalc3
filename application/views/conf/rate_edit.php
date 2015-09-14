<?php
// libraries
$this->load->helper('form');
$this->load->helper('url');
?>

<?php $this->load->view('main_topmost'); ?>

<html lang="ru">

<?php    $data['tit'] = 'Курс валюты';
    $this->load->view('main_head', $data['tit']);
?>

<body>

<?php
/**
 * @todo
 * - validation!!!
 */

?>

<?php $this->load->view('main_navbar'); ?>

<div class="container">

    <h3>
        <?=$cur_nam?>: изменения курса
        <?php            if($mode == 'ed') echo ": редактирование";
            elseif($mode == 'nw') echo ": добавление";
            elseif($mode == 'dl') echo ": удаление";
        ?>
    </h3>

    <?php    // prepare vars
    $dat = $row['dat'];
    $price = $row['price'];
    ?>

    <?php    // validation errors
    $estr = validation_errors();
    $evisi = !empty($estr) ? '' : 'style="display: none"';
    ?>

    <div class="alert alert-danger" role="alert" <?=$evisi?> > <?php echo 'test' . $estr; ?> </div>

    <?php    // readonly attribute for input
    $dlmark = '';
    $edmark = '';
    if($mode == 'dl') $dlmark = 'readonly';
    if($mode == 'ed') $edmark = 'readonly';
    ?>

    <?php    //prepare form properties array
    $auxar = array('class' => 'form-horizontal',);
    // open form in proper way
    if($mode == 'ed')       echo form_open("conf_rate/edit/$rate_id", $auxar);
    if($mode == 'nw')       echo form_open("conf_rate/add/$cur_id", $auxar);
    if($mode == 'dl')       echo form_open("conf_rate/del/$rate_id", $auxar);
    ?>

        <div class="form-group">
            <label for="input_dat" class="control-label col-sm-2">Дата</label>
            <div class="col-sm-2">
                <input type="date" class="form-control" id="input_dat" <?=$edmark?> <?=$dlmark?> name="dat" value="<?=$dat?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="input_price" class="control-label col-sm-2">Стоимость за <?=$mult?></label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="input_price" <?=$dlmark?> name="price" value="<?=$price?>"/>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2">
                <button type="submit" class="btn btn-primary" name="btn_save">
                    <?php echo $mode == 'dl' ? 'Удалить' : 'Сохранить' ?>
                </button>

                <?php                $ar = array(
                    'type' => 'button',
                    'class' => 'btn btn-primary',
                    'name' => 'btn_cancel',
                );
                echo anchor("conf_rate/index/$cur_id", 'Отмена', $ar);
                ?>

            </div>
        </div>


    <?php    echo form_close();
    ?>





</div>
</body>
</html>
