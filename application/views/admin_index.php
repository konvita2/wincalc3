<?

// главная административная страница
// требуются админ права для открытия

?>

<? $this->load->helper('url'); ?>

<? $this->load->view('main_topmost'); ?>

<!DOCTYPE html>
<html lang="en">

<?
$data['tit'] = 'Административный раздел';
$this->load->view('main_head', $data);
?>

<body>

<? $this->load->view('main_navbar'); ?>

<div class="container">

    <h2>Административный раздел</h2>

    <h3>Справочники</h3>

    <div class="row">
        <? echo anchor('users', 'Пользователи', array('class' => 'btn btn-default')); ?>
    </div>

    <div class="row">
        <? echo anchor('conf_curr', 'Валюта', array('class' => 'btn btn-default')); ?>
    </div>

    <div class="row">
        <? echo anchor('conf_glass', 'Стеклопакеты', array('class' => 'btn btn-default')); ?>
        <? echo anchor('profil', 'Оконные профили', array('class' => 'btn btn-default')); ?>
    </div>


</div>

</body>
</html>