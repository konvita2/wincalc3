<? defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?
// libraries
$this->load->helper('form');
$this->load->helper('url');
?>

<? $this->load->view('main_topmost'); ?>

<html lang="ru">

<?
$dt['tit'] = 'Загрузка прайса глухого окна';
$this->load->view('main_head', $dt);
?>

<body>

<? $this->load->view('main_navbar'); ?>

<div class="container">

    <h3>Работа с прайсами</h3>

    <?
    $ar = array('class' => "btn btn-default");
    echo anchor('price/load', 'Загрузки прайс', $ar);
    ?>

</div>

<div class="container text-info">

    <?


    ?>

</div>

</body>
</html>

