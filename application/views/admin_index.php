<?php
//
// главная административная страница
// требуются админ права для открытия

?>

<?php $this->load->helper('url'); ?>

<?php $this->load->view('main_topmost'); ?>

<!DOCTYPE html>
<html lang="en">

<?php
$data['tit'] = 'Административный раздел';
$this->load->view('main_head', $data);
?>

<body>

<?php $this->load->view('main_navbar'); ?>

<div class="container">

    <h2>Административный раздел</h2>

    <h3>Справочники</h3>

    <div class="panel panel-default">
        <div class="panel-heading">Общие</div>
        <div class="panel-body">
            <?php echo anchor('users', 'Пользователи', array('class' => 'btn btn-default')); ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Калькуляция</div>
        <div class="panel-body">
            <?php echo anchor('conf_curr', 'Валюта', array('class' => 'btn btn-default')); ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Материалы</div>
        <div class="panel-body">
            <?php echo anchor('conf_glass', 'Стеклопакеты', array('class' => 'btn btn-default')); ?>
            <?php echo anchor('profil', 'Оконные профили', array('class' => 'btn btn-default')); ?>
            <?php echo anchor('price', 'Прайсы (удалить)', array('class' => 'btn btn-default')); ?>
            <?php echo anchor('furn', 'Фурнитура', array('class' => 'btn btn-default')); ?>
            <?php echo anchor('grfurn', 'Группы фурнитуры', array('class' => 'btn btn-default')); ?>
        </div>
    </div>



</div>

</body>
</html>