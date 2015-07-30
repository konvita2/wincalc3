<?

// страница для отображения сообщения о т.ч.
// требуются административные права

?>

<? $this->load->helper('url'); ?>

<? $this->load->view('main_topmost'); ?>

<!DOCTYPE html>
<html lang="en">

<?
$data['tit'] = 'Логин';
$this->load->view('main_head', $data);
?>

<body>

<? $this->load->view('main_navbar'); ?>

<div class="container">

    <? if(!isset($login_error)): ?>
        <div class="jumbotron">
            <h2>Административный раздел</h2>
            <p>Для входа на данную страницу необходимо выполнить авторизацию</p>
        </div>
    <? else: ?>

        <? if($login_error == 1): ?> // not admin

            <div class="jumbotron">
                <h2>Административный раздел</h2>
                <p>Для входа на данную страницу необходимо иметь права администратора</p>
            </div>

        <? elseif($login_error == 2):  ?>

            <div class="jumbotron">
                <h2>Административный раздел</h2>
                <p>Для входа на данную страницу необходимо иметь права администратора</p>
            </div>

        <? endif ?>

    <? endif ?>

</div>

</body>
</html>