<? $this->load->helper('url'); ?>

<? $this->load->view('main_topmost'); ?>

<!DOCTYPE html>
<html lang="ru">

<?
$dt['tit'] = 'Справочник пользователей';
$this->load->view('main_head', $dt);
?>

<body>

<? $this->load->view('main_navbar'); ?>

<div class="container">

    <h3>Справочник пользователей</h3>

    <a class="btn btn-primary" href="<?=base_url('index.php/users/add')?>">Добавить пользователя</a>

    <table class="table">

        <thead>
            <th>Логин</th>
            <th>Email</th>
            <th>Описание</th>
            <th>Активность</th>
            <th>Действия</th>
        </thead>

        <tbody>
            <? foreach($rows as $row): ?>

                <? $active = $row['active'] == 0 ? "" : "Да"; ?>

            <td><?=$row['username']?></td>
            <td><?=$row['email']?></td>
            <td><?=$row['description']?></td>
            <td><?=$active?></td>
            <td></td>

            <? endforeach ?>
        </tbody>

    </table>



</div>

</body>
</html>