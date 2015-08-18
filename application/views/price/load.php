<? defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?
// libraries
$this->load->helper('form');
$this->load->helper('url');
?>

<? $this->load->view('main_topmost'); ?>

<html lang="ru">

<?
$dt['tit'] = 'Загрузка прайса';
$this->load->view('main_head', $dt);
?>

<body>

<? $this->load->view('main_navbar'); ?>

<div class="container">

    <h3>Загрузка прайса</h3>

    <h4>Глухое окно</h4>

    <!-- error -->
    <?
    $estr = $errors;
    $evisi = !empty($estr) ? '' : 'style="display: none"';
    ?>

    <div class="alert alert-danger" role="alert" <?=$evisi?> > <? echo $estr; ?></div>

    <!-- form open -->
    <? echo  form_open_multipart('price/glload', array('class' => 'form-horizontal',)); ?>

    <div class="form-group">
        <label for="csvfile" class="control-label col-sm-2">Прайс в CSV-формате</label>
        <div class="col-sm-6">
            <input type="file" class="form-control"
                   id="csvfile" name="userfile"/>
        </div>
    </div>

    <!-- buttons -->
    <div class="form-group">

        <div class="col-sm-offset-2">
            <button type="submit" class="btn btn-primary" name="btn_save" id="btn_save">
                Загрузить
            </button>

            <?
            // @todo change link to other page
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
