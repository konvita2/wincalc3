<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->helper('url'); ?>

<?php $this->load->view('main_topmost'); ?>

<!DOCTYPE html>
<html lang="ru">

<?php
$dt['tit'] = 'Прайс на глухое окно (без СП)';
$this->load->view('main_head', $dt);
?>

<body>

<?php $this->load->view('main_navbar'); ?>

<div class="container">

    <h3>Прайс на глухое окно (без СП)</h3>

    <!-- @todo add input date trough separate key in data -->

    <table class="table table-condensed table-hover">

        <thead>
        <th>Ширина мин, мм</th>
        <th>Ширина макс, мм</th>
        <th>Высота мин, мм</th>
        <th>Высота макс, мм</th>
        <th>Цена, грн</th>
        </thead>

        <tbody>
            <?php foreach($rows as $row): ?>
                <tr>
                    <td><?=$row['minx']?></td>
                    <td><?=$row['maxx']?></td>
                    <td><?=$row['miny']?></td>
                    <td><?=$row['maxy']?></td>
                    <td><?=$row['price']?></td>
                </tr>
            <?php endforeach ?>
        </tbody>

</div>

</body>
</html>
