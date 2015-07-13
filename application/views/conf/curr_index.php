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

<? $this->load->helper('url'); ?>

<? $this->load->view('main_topmost'); ?>

<!DOCTYPE html>
<html lang="en">

<? $this->load->view('main_head'); ?>

<body>

    <? $this->load->view('main_navbar'); ?>

    <div class="container">

        <h3>Справочник валют</h3>

        <a class="btn btn-primary" href="<?=base_url('index.php/conf_curr/add')?>">Добавить валюту</a>

        <table class="table">

            <thead>
            <tr>
                <td>Код</td>
                <td>Наименование</td>
                <td>Множитель</td>
                <td>Действия</td>
            </tr>
            </thead>

            <tbody>

            <? foreach($currs as $curr): ?>

                <tr>
                    <td><?=$curr['id']?></td>
                    <td><?=$curr['nam']?></td>
                    <td><?=$curr['mult']?></td>

                    <td>
                        <? $href = base_url('index.php/conf_curr/edit/' . $curr['id']); ?>
                        <a class="btn btn-primary" href="<?=$href?>">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>

                        <? $href = base_url('index.php/conf_curr/del/' . $curr['id']); ?>
                        <a class="btn btn-primary" type="button" href="<?=$href?>">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </td>

                </tr>

            <? endforeach  ?>

            </tbody>

        </table>

    </div>

</body>
</html>
