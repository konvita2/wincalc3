<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
// libraries
$this->load->helper('form');
$this->load->helper('url');
?>

<?php $this->load->view('main_topmost'); ?>

<html lang="ru">

<?php
$dt['tit'] = 'Работа с прайсами';
$this->load->view('main_head', $dt);
?>

<body>

<?php $this->load->view('main_navbar'); ?>

<div class="container">

    <h3>Работа с прайсами</h3>

    <?php    // class for btn
    $ar = array('class' => "btn btn-primary");
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            Просмотр текущих цен на профиль
        </div>
        <div class="panel-body">
            <?php            echo anchor('price/filtergl', 'Глухое окно', $ar);
            ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Новые цены
        </div>
        <div class="panel-body">
            <?php            echo anchor('price/load', 'Загрузки прайс', $ar);
            ?>
        </div>
    </div>

</div>

</body>
</html>

