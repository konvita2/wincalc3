<? defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?
// libraries
$this->load->helper('form');
$this->load->helper('url');
?>

<? $this->load->view('main_topmost'); ?>

<html lang="ru">

<?
$dt['tit'] = 'Профили редактор';
$this->load->view('main_head', $dt);
?>

<body>

<? $this->load->view('main_navbar'); ?>

<div class="container">

    <h3>
        Профили:
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
            Вы уверены в том, что хотите удалить выбранный профиль?
        </div>
    <? endif ?>

    <!-- validation errors -->

    <?php
    // validation errors
    $estr = validation_errors();
    $evisi = !empty($estr) ? '' : 'style="display: none"';
    ?>

    <div class="alert alert-danger" role="alert" <?=$evisi?> > <? echo $estr; ?> </div>

    <!-- dl marks -->
    <?

    $dlmark = '';
    if($mode == 'dl'){
        $dlmark = 'readonly';
    }

    ?>

    <!-- form open -->
    <?
    if($mode == 'nw'){
        $ar = array('class' => 'form-horizontal');
        echo form_open('profil/add',$ar);
    }
    elseif($mode == 'ed'){
        $ar = array('class' => 'form-horizontal');
        echo form_open("profil/edit/$id",$ar);
    }
    elseif($mode == 'dl'){
        $ar = array('class' => 'form-horizontal');
        echo form_open("profil/del/$id",$ar);
    }
    ?>

    <div class="form-group">
        <label for="id" class="control-label col-sm-2">Код</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" readonly
                   id="id" name="id" value="<?=$id?>"/>
        </div>
    </div>

    <div class="form-group">
        <label for="nam" class="control-label col-sm-2">Обозначение</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" <?=$dlmark?>
                   id="nam" name="nam" value="<? echo set_value('nam',$nam); ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label for="description" class="control-label col-sm-2">Описание</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" <?=$dlmark?>
                   id="description" name="description" value="<? echo set_value('description',$description); ?>"/>
        </div>
    </div>

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
            echo anchor('profil/index', 'Отмена', $ar);
            ?>

        </div>
    </div>



    <!-- form close -->
    <? echo form_close(); ?>


</div>

</body>
</html>