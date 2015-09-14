<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
// libraries
$this->load->helper('form');
$this->load->helper('url');
?>

<?php $this->load->view('main_topmost'); ?>

<html lang="ru">

<?php
$dt['tit'] = 'Загрузка прайса';
$this->load->view('main_head', $dt);
?>

<body>

<?php $this->load->view('main_navbar'); ?>

<div class="container">

    <h3>Загрузка прайса</h3>

    <!-- глухое окно -->
    <div class="panel panel-default">
        <div class="panel-heading">Глухое окно</div>

        <div class="panel-body">
            <!-- error -->
            <?php            $estr = $errors;
            $evisi = !empty($estr) ? '' : 'style="display: none"';
            ?>

            <div class="alert alert-danger" role="alert" <?=$evisi?> > <?php echo $estr; ?></div>

            <!-- form open -->
            <?php echo  form_open_multipart('price/glload', array('class' => 'form-horizontal',)); ?>

            <div class="form-group">
                <label for="profil" class="control-label col-sm-2">Профиль</label>
                <div class="col-sm-3">
                    <select class="form-control" id="profil" name="profil">
                        <?php foreach($profil as $pr): ?>
                            <option value="<?=$pr['sym']?>"><?=$pr['description']?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

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

                    <?php                    // @todo change link to other page
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
            <?php echo form_close(); ?>

        </div>
    </div>


</div>
</body>
</html>
