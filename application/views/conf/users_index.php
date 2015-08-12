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
            <th>Код</th>
            <th>Логин</th>
            <th>Email</th>
            <th>Описание</th>
            <th>Активность</th>
            <th>Админ</th>
            <th>Действия</th>
        </thead>

        <tbody>
            <? foreach($rows as $row): ?>
            <tr>

                <? $active = $row['active'] == 0 ? "" : "Да"; ?>
                <? $admin = $row['admin'] == 0 ? "" : "Да"; ?>

                <td><?=$row['id']?></td>
                <td><?=$row['username']?></td>
                <td><?=$row['email']?></td>
                <td><?=$row['description']?></td>
                <td><?=$active?></td>
                <td><?=$admin?></td>
                <td> <!-- actions -->

                    <? $href = base_url('index.php/users/edit/' . $row['id']); ?>
                    <a class="btn btn-primary" href="<?=$href?>" title="Редактировать">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>

                    <? $href = base_url('index.php/users/del/' . $row['id']); ?>
                    <a class="btn btn-primary" type="button" href="<?=$href?>" title="Удалить">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>

                    <? $href = base_url('index.php/users/psw/' . $row['id']); ?>
                    <a class="btn btn-primary" type="button" href="<?=$href?>" title="Сменить пароль">
                        <span class="glyphicon glyphicon-lock"></span>
                    </a>

                </td>

            </tr>
            <? endforeach ?>

        </tbody>

    </table>

</div>

</body>
</html>