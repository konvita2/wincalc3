<?php $this->load->helper('url'); ?>

<?php $this->load->view('main_topmost'); ?>

<!DOCTYPE html>
<html lang="en">

<?php
$data['tit'] = 'Логин';
$this->load->view('main_head', $data);
?>

<body>

<?php $this->load->view('main_navbar'); ?>

    <div class="container">

        <div class="jumbotron">
            <h2>Административный раздел</h2>
            <p>Для входа на данную страницу необходимо выполнить авторизацию</p>
        </div>

    </div>

</body>
</html>
