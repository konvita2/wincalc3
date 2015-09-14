<?php
/**
 * Справочник валют: перечень
 * Created by PhpStorm.
 * User: User
 * Date: 13.07.2015
 * Time: 11:36
 */

/**
 * @todo
 * - добавить отображение курса на тек дату (дату указывать)
 *     добавить колонку в таблице
 * - сделать переход на страницу ввода курсов валют
 */

?>

<?php $this->load->helper('url'); ?>

<?php $this->load->view('main_topmost'); ?>

<!DOCTYPE html>
<html lang="en">

<?php    $dt['tit'] = 'Справочник валют';
    $this->load->view('main_head', $dt);
?>

<body>

    <?php $this->load->view('main_navbar'); ?>

    <div class="container">

        <h3>Справочник валют</h3>

        <a class="btn btn-primary" href="<?=base_url('index.php/conf_curr/add')?>">Добавить валюту</a>

        <table class="table">

            <thead>
            <tr>
                <td>Код</td>
                <td>Наименование</td>
                <td>Множитель</td>
                <td>Курс на <?=$today?></td>
                <td>Действия</td>
            </tr>
            </thead>

            <tbody>

            <?php foreach($currs as $curr): ?>

                <tr>
                    <td><?=$curr['id']?></td>
                    <td><?=$curr['nam']?></td>
                    <td><?=$curr['mult']?></td>

                    <td><?php printf("%.2f",$curr['rate']); ?></td>

                    <td>
                        <?php $href = base_url('index.php/conf_curr/edit/' . $curr['id']); ?>
                        <a class="btn btn-primary" href="<?=$href?>" title="Редактировать">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>

                        <?php $href = base_url('index.php/conf_curr/del/' . $curr['id']); ?>
                        <a class="btn btn-danger" type="button" href="<?=$href?>" title="Удалить">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>

                        <?php $href = base_url('index.php/conf_rate/index/' . $curr['id']); ?>
                        <a class="btn btn-default" type="button" href="<?=$href?>" title="Таблица изменения курса">
                            <span class="glyphicon glyphicon-usd"></span>
                        </a>

                    </td>

                </tr>

            <?php endforeach  ?>

            </tbody>

        </table>

    </div>

</body>
</html>
