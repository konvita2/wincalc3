<?
    // libraries
    $this->load->helper('form');
    $this->load->helper('url');
?>


<? $this->load->view('main_topmost'); ?>

<html lang="ru">

<?
    $dt['tit'] = 'Валюта редактор';
    $this->load->view('main_head', $dt);
?>

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
        Валюта:
        <? if($mode == 'ed'): ?>
            редактирование
        <? elseif($mode == 'dl'): ?>
            удаление
        <? elseif($mode == 'nw'): ?>
            добавление новой
        <? else: ?>
            неизвестная команда
        <? endif ?>
    </h3>

    <? if($mode == 'dl'): ?>
        <div class="alert alert-danger">
            Вы уверены в том, что хотите удалить выбранную валюту?
        </div>
    <? endif ?>

    <?
    // readonly attribute for input
    if($mode == 'dl') $dlmark = 'readonly';
    else $dlmark = '';
    ?>

    <? $ar = array('class' => 'form-horizontal',); ?>

    <?
    // validation errors
    $estr = validation_errors();
    $evisi = !empty($estr) ? '' : 'style="display: none"';
    ?>

    <div class="alert alert-danger" role="alert" <?=$evisi?>><? echo $estr; ?></div>

    <!-- form -->

    <?

    $id = $row['id'];
    $nam = $row['nam'];
    $mult = $row['mult'];

    if($mode == 'ed'){
        echo form_open("conf_curr/edit/$id", $ar);
    }
    elseif($mode == 'dl'){
        echo form_open("conf_curr/del/$id", $ar);
    }
    else{
        // @todo add branch
        echo form_open("conf_curr/add/", $ar);
    }

    ?>

        <div class="form-group">
            <label for="input_id" class="control-label col-sm-2">Код</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="input_id" name="id" readonly value="<?=$id?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="input_nam" class="control-label col-sm-2">Наименование</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="input_nam" name="nam" <?=$dlmark?>
                       value="<? echo $nam; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="input_mult" class="control-label col-sm-2">Множитель для курса</label>
            <div class="col-sm-2">
                <input type="number" class="form-control" id="input_mult" name="mult" <?=$dlmark?>
                       value="<? echo $mult; ?>"/>
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
                echo anchor('conf_curr', 'Отмена', $ar);
                ?>

            </div>
        </div>

    </form>



</div>

</body>
</html>
