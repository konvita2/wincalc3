<?php $this->load->view('main_topmost'); ?>
<html lang="ru">

<?php $this->load->helper('url'); ?>

<?php $this->load->view('main_head'); ?>

<body>

<?php $this->load->view('main_navbar'); ?>

<div class="container">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Успешно выполнено</h3>
        </div>
        <div class="panel-body">
            <p><?=$textinfo?></p>
        </div>
    </div>

    <?php
    $ar = array(
        'class' => 'btn btn-primary',
    );
    echo anchor("conf_rate/index/$cur_id",'К таблице изменения курса',$ar);

    ?>


</div>

</body>
</html>
