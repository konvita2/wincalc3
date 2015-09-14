
<?php $this->load->helper('url'); ?>

<?php $this->load->view('main_topmost'); ?>

<!DOCTYPE html>
<html lang="en">

<?php    $dt['tit'] = 'Таблица курсов валюты';
    $this->load->view('main_head', $dt);
?>

<body>

<?php $this->load->view('main_navbar'); ?>

    <div class="container">

        <a class="btn btn-primary" href="<?=base_url("index.php/conf_curr/")?>">К списку валют</a>

        <h3><?=$cur_nam?>: таблица изменения курса</h3>

        <a class="btn btn-primary" href="<?=base_url("index.php/conf_rate/add/$cur_id")?>">Добавить (изменить) курс</a>

        <table class="table">
            <thead>
            <tr>
                <td>Дата</td>
                <td>Курс за <?=$mult?></td>
                <td>Действия</td>
            </tr>
            </thead>

            <tbody>

            <?php foreach($rates as $rate): ?>

                <?php
                $dat = $rate['dat'];
                $price = $rate['price'];
                $rate_id = $rate['id'];

                ?>

                <tr>

                    <td><?=$dat?></td>

                    <td><?php printf('%.2f',$price); ?></td>

                    <td>

                        <?php $href = base_url("index.php/conf_rate/edit/$rate_id"); ?>
                        <a class="btn btn-primary" href="<?=$href?>" title="Редактировать">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>

                        <?php $href = base_url("index.php/conf_rate/del/$rate_id"); ?>
                        <a class="btn btn-danger" type="button" href="<?=$href?>" title="Удалить">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>

                    </td>

                </tr>

            <?php endforeach ?>

            </tbody>

        </table>


    </div>

</body>
</html>

