<? defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<? $this->load->helper('url'); ?>

<? $this->load->view('main_topmost'); ?>

<!DOCTYPE html>
<html lang="ru">

<?
$dt['tit'] = 'Справочник профилей';
$this->load->view('main_head', $dt);
?>

<body>

<? $this->load->view('main_navbar'); ?>

    <div class="container">

    <h3>Справочник оконных профилей</h3>

    <a class="btn btn-primary" href="<?=base_url('index.php/profil/add')?>">Добавить новый профиль</a>

        <table class="table">

            <thead>
                <th>Код</th>
                <th>Обозначение</th>
                <th>Описание</th>
                <th>Ширина для стеклопакета</th>
                <th>Действия</th>
            </thead>

            <tbody>
                <? foreach ($rows as $row): ?>
                    <tr>

                    <td><?=$row['id']?></td>
                    <td><?=$row['nam']?></td>
                    <td><?=$row['description']?></td>
                    <td><?=$row['width_for_glass']?></td>

                    <td> <!-- actions -->

                        <? $href = base_url('index.php/profil/edit/' . $row['id']); ?>
                        <a class="btn btn-primary" href="<?=$href?>" title="Редактировать">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>

                        <? $href = base_url('index.php/profil/del/' . $row['id']); ?>
                        <a class="btn btn-primary" type="button" href="<?=$href?>" title="Удалить">
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