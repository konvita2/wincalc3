
<? $this->load->helper('url'); ?>

<? $this->load->view('main_topmost'); ?>

<!DOCTYPE html>
<html lang="en">

<? $this->load->view('main_head'); ?>

<body>

<? $this->load->view('main_navbar'); ?>

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

            <? foreach($rates as $rate): ?>

                <?

                $dat = $rate['dat'];
                $price = $rate['price'];
                $rate_id = $rate['id'];

                ?>

                <tr>

                    <td><?=$dat?></td>

                    <td><? printf('%.2f',$price); ?></td>

                    <td>

                        <? $href = base_url("index.php/conf_rate/edit/$rate_id"); ?>
                        <a class="btn btn-primary" href="<?=$href?>" title="Редактировать">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>

                        <? $href = base_url("index.php/conf_curr/del/$rate_id"); ?>
                        <a class="btn btn-danger" type="button" href="<?=$href?>" title="Удалить">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>

                    </td>

                </tr>

            <? endforeach ?>

            </tbody>

        </table>


    </div>

</body>
</html>

