<? defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?
// libraries
$this->load->helper('form');
$this->load->helper('url');
?>

<? $this->load->view('main_topmost'); ?>

<html lang="ru">

<?
$dt['tit'] = 'Работа с прайсами';
$this->load->view('main_head', $dt);
?>

<body>

<? $this->load->view('main_navbar'); ?>

<div class="container">

    <h3>Работа с прайсами</h3>

    <?
    // class for btn
    $ar = array('class' => "btn btn-primary");
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            Просмотр текущих цен на профиль
        </div>
        <div class="panel-body">
            <?
            echo anchor('price/showgl', 'Глухое окно', $ar);
            ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Новые цены
        </div>
        <div class="panel-body">
            <?
            echo anchor('price/load', 'Загрузки прайс', $ar);
            ?>
        </div>
    </div>

</div>

</body>
</html>

