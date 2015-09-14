<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
// libraries
$this->load->helper('form');
$this->load->helper('url');
?>

<?php $this->load->view('main_topmost'); ?>

<html lang="ru">

<?php
$dt['tit'] = 'Прайс глухого окна';
$this->load->view('main_head', $dt);
?>

<body>

<?php $this->load->view('main_navbar'); ?>

<div class="container">

    <h3>Прайс глухого окна</h3>

    <div class="panel panel-default">
        <div class="panel-body">
            <?php $ar = array('class' => 'btn btn-primary'); ?>
            <?php echo anchor('price','Работа с прайсами',$ar); ?>
            <?php echo anchor('price/load','Загрузить новый прайс',$ar); ?>
        </div>
    </div>

    <h4>Профиль: <?=$profil_description?></h4>

    <table class="table">

        <thead>
            <th>№</th>
            <th>Ширина мин</th>
            <th>Ширина макс</th>
            <th>Высота мин</th>
            <th>Высота макс</th>
            <th>Цена</th>
        </thead>

        <tbody>

            <?php $npp = 1; ?>
            <?php foreach($csv as $row): ?>
                <tr>

                    <td><?=$npp?></td>
                    <td><?=$row['w']?></td>
                    <td><?=$row['wmax']?></td>
                    <td><?=$row['h']?></td>
                    <td><?=$row['hmax']?></td>
                    <td><?=$row['p']?></td>

                    <?php $npp++; ?>

                </tr>
            <?php endforeach ?>

        </tbody>

    </table>




</div>

</body>
</html>
