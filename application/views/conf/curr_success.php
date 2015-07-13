<? $this->load->view('main_topmost'); ?>
<html lang="ru">

<? $this->load->helper('url'); ?>

<? $this->load->view('main_head'); ?>

<body>

<? $this->load->view('main_head'); ?>

<div class="container">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Успешно выполнено</h3>
        </div>
        <div class="panel-body">
            <p><?=$textinfo?></p>
        </div>
    </div>

    <a class="btn btn-primary" href="<?=base_url().'index.php/conf_curr'?>">К списку валют</a>


</div>

</body>
</html>
