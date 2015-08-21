<? defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<? $this->load->helper('url'); ?>

<? $this->load->view('main_topmost'); ?>

<!DOCTYPE html>
<html lang="ru">

<?
$dt['tit'] = 'Прайс на глухое окно (без СП)';
$this->load->view('main_head', $dt);
?>

<body>

<? $this->load->view('main_navbar'); ?>

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
            <? foreach($rows as $row): ?>
                <tr>
                    <td><?=$row['minx']?></td>
                    <td><?=$row['maxx']?></td>
                    <td><?=$row['miny']?></td>
                    <td><?=$row['maxy']?></td>
                    <td><?=$row['price']?></td>
                </tr>
            <? endforeach ?>
        </tbody>

</div>

</body>
</html>
