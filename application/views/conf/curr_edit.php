<? $this->load->helper('form'); ?>
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
        Стеклопакеты:
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

    <? $ar = array('class' => 'form-horizontal',); ?>
    <? echo validation_errors(); ?>

    <!-- form -->

    <?

    $id = $row['id'];
    $nam = $row['nam'];
    $mult = $row['mult'];

    if(($mode == 'ed') || ($mode == 'dl')){
        // ed/dl @todo make branch
        echo form_open("conf_curr/edit/$id", $ar);
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
                <input type="text" class="form-control" id="input_nam" name="nam" value="<?=$nam?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="input_mult" class="control-label col-sm-2">Множитель для курса</label>
            <div class="col-sm-2">
                <input type="number" class="form-control" id="input_mult" name="mult" value="<?=$mult?>"/>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2">
                <button type="submit" class="btn btn-primary" name="btn_save">
                    <? echo $mode == 'dl' ? 'Удалить' : 'Сохранить' ?>
                </button>
                <a type="button" class="btn btn-primary"
                   href="index"  <? // @todo change href  ?>
                   name="btnCancel">Отмена</a>
            </div>
        </div>

    </form>



</div>

</body>
</html>
