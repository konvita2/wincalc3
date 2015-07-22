<?
// libraries
$this->load->helper('form');
$this->load->helper('url');
?>


<? $this->load->view('main_topmost'); ?>

<html lang="ru">

<? $this->load->view('main_head'); ?>

<body>

<?

/**
 * @todo
 * - validation!!!
 */

?>

<? $this->load->view('main_navbar'); ?>

<div class="container">

    <h3>
        <?=$cur_nam?>: изменения курса
        <?
            if($mode == 'ed') echo ": редактирование";
            elseif($mode == 'nw') echo ": добавление";
            elseif($mode == 'dl') echo ": удаление";
        ?>
    </h3>

    <?
    // prepare vars
    $dat = $row['dat'];
    $price = $row['price'];
    ?>

    <?
    // validation errors
    $estr = validation_errors();
    $evisi = !empty($estr) ? '' : 'style="display: none"';
    ?>

    <div class="alert alert-danger" role="alert" <?=$evisi?> > <? echo 'test' . $estr; ?> </div>

    <?
    // readonly attribute for input
    $dlmark = '';
    if($mode == 'dl') $dlmark = 'readonly';
    if($mode == 'ed') $dlmark = 'readonly';
    ?>

    <?
    //prepare form properties array
    $auxar = array('class' => 'form-horizontal',);
    // open form in proper way
    if($mode == 'ed')       echo form_open("conf_rate/edit/$rate_id", $auxar);
    //elseif($mode == 'nw')
    //elseif($mode == 'dl')
    ?>

        <div class="form-group">
            <label for="input_dat" class="control-label col-sm-2">Дата</label>
            <div class="col-sm-2">
                <input type="date" class="form-control" id="input_dat" <?=$dlmark?> name="dat" value="<?=$dat?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="input_price" class="control-label col-sm-2">Стоимость за <?=$mult?></label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="input_price" name="price" value="<?=$price?>"/>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2">
                <button type="submit" class="btn btn-primary" name="btn_save">
                    <? echo $mode == 'dl' ? 'Удалить' : 'Сохранить' ?>
                </button>

                <?
                $ar = array(
                    'type' => 'button',
                    'class' => 'btn btn-primary',
                    'name' => 'btn_cancel',
                );
                echo anchor("conf_rate/index/$cur_id", 'Отмена', $ar);
                ?>

            </div>
        </div>


    <?
    echo form_close();
    ?>





</div>
</body>
</html>
