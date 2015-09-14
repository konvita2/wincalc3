<?php    // libraries
    $this->load->helper('form');
    $this->load->helper('url');
?>


<?php $this->load->view('main_topmost'); ?>

<html lang="ru">

<?php    $dt['tit'] = 'Валюта редактор';
    $this->load->view('main_head', $dt);
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
        Валюта:
        <?php if($mode == 'ed'): ?>
            редактирование
        <?php elseif($mode == 'dl'): ?>
            удаление
        <?php elseif($mode == 'nw'): ?>
            добавление новой
        <?php else: ?>
            неизвестная команда
        <?php endif ?>
    </h3>

    <?php if($mode == 'dl'): ?>
        <div class="alert alert-danger">
            Вы уверены в том, что хотите удалить выбранную валюту?
        </div>
    <?php endif ?>

    <?php    // readonly attribute for input
    if($mode == 'dl') $dlmark = 'readonly';
    else $dlmark = '';
    ?>

    <?php $ar = array('class' => 'form-horizontal',); ?>

    <?php    // validation errors
    $estr = validation_errors();
    $evisi = !empty($estr) ? '' : 'style="display: none"';
    ?>

    <div class="alert alert-danger" role="alert" <?=$evisi?>><?php echo $estr; ?></div>

    <!-- form -->

    <?php
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
                       value="<?php echo $nam; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="input_mult" class="control-label col-sm-2">Множитель для курса</label>
            <div class="col-sm-2">
                <input type="number" class="form-control" id="input_mult" name="mult" <?=$dlmark?>
                       value="<?php echo $mult; ?>"/>
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
                echo anchor('conf_curr', 'Отмена', $ar);
                ?>

            </div>
        </div>

    </form>



</div>

</body>
</html>
