<?php

// страница для отображения сообщения о т.ч.
// требуются административные права

?>

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

    <?php if(!isset($login_error)): ?>
        <div class="jumbotron">
            <h2>Административный раздел</h2>
            <p>Для входа на данную страницу необходимо выполнить авторизацию</p>
        </div>
    <?php else: ?>

        <?php if($login_error == 1): ?> // not admin

            <div class="jumbotron">
                <h2>Административный раздел</h2>
                <p>Для входа на данную страницу необходимо иметь права администратора</p>
            </div>

        <?php elseif($login_error == 2):  ?>

            <div class="jumbotron">
                <h2>Административный раздел</h2>
                <p>Вход не выполнен: неправильный пароль или имя пользователя</p>
            </div>

        <?php endif ?>

    <?php endif ?>

</div>

</body>
</html>