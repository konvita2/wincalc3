<? defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?
// libraries
$this->load->helper('form');
$this->load->helper('url');
?>

<? $this->load->view('main_topmost'); ?>

<html lang="ru">

<?
$dt['tit'] = 'Прайс глухого окна';
$this->load->view('main_head', $dt);
?>

<body>

<? $this->load->view('main_navbar'); ?>

<div class="container">

    <h3>Прайс глухого окна</h3>

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

            <? $npp = 1; ?>
            <? foreach($csv as $row): ?>
                <tr>

                    <td><?=$npp?></td>
                    <td><?=$row['w']?></td>
                    <td><?=$row['wmax']?></td>
                    <td><?=$row['h']?></td>
                    <td><?=$row['hmax']?></td>
                    <td><?=$row['p']?></td>

                    <? $npp++; ?>

                </tr>
            <? endforeach ?>

        </tbody>

    </table>




</div>

</body>
</html>
