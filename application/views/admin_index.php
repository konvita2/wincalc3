<?

// главная административная страница
// требуются админ права для открытия

?>

<? $this->load->helper('url'); ?>

<? $this->load->view('main_topmost'); ?>

<!DOCTYPE html>
<html lang="en">

<?
$data['tit'] = 'Настройки';
$this->load->view('main_head', $data);
?>

<body>

<? $this->load->view('main_navbar'); ?>

<div class="container">

    <h2>Настройки</h2>

    <h3>Справочники</h3>

    <? echo anchor('conf_curr', 'Валюта', array('class' => 'btn btn-default')); ?>

</div>

</body>
</html>