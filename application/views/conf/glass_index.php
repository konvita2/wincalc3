<html lang="ru">

<?
    $this->load->helper('url');
?>

<? $this->load->view('main_head'); ?>

<body>

<? $this->load->view('main_navbar'); ?>

<div class="container">

    <h3>Справочник стеклопакетов</h3>

    <a class="btn btn-primary" href="<?=base_url('index.php/conf_glass/add')?>">Добавить стеклопакет</a>

    <table class="table">

        <thead>
        <tr>
            <td>Код</td>
            <td>Наименование</td>
            <td>Описание</td>
            <td>Вал</td>
            <td>Цена за 1 кв.м</td>
            <td>Действия</td>
        </tr>
        </thead>

        <tbody>

        <? foreach($glasses as $glass): ?>

            <tr>
                <td><?=$glass['id']?></td>
                <td><?=$glass['nam']?></td>
                <td><?=$glass['description']?></td>

                <td><?=$glass['cur_name']?></td>
                <td><?=$glass['price']?></td>

                <td>
                    <? $href = base_url('index.php/conf_glass/edit/' . $glass['id']); ?>
                    <a class="btn btn-primary" href="<?=$href?>">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>

                    <? $href = base_url('index.php/conf_glass/del/' . $glass['id']); ?>
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

