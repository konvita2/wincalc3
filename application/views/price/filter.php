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

    <h3 id="tit">Прайс на глухое окно (без СП)</h3>

    <div class="panel panel-default">
        <div class="panel-heading">Укажите профильную систему</div>
        <div class="panel-body">
            <? echo $select; ?>
            <? // @todo change sort order in profil systems (by desc?) ?>
        </div>
    </div>

    <table class="table">
        <thead id="tableheader">
            <th>Ширина мин, мм</th>
            <th>Ширина макс, мм</th>
            <th>Высота мин, мм</th>
            <th>Высота макс, мм</th>
            <th>Цена, грн</th>
        </thead>
        <tbody id="tablebody"></tbody>
    </table>

    </div>

    <script type="text/javascript">

        $(document).ready(
            function () {
                $('#profil').bind('change',function(){
                    var profil_sym = $('#profil').val();
                    $.post(
                        '/index.php/price/afilter',
                        {
                            "profil_sym": profil_sym
                        },
                        function(data) {
                            $('#tablebody').html('');

                            var str = '';
                            for(var i in data.table)
                            {
                                str = str + '<tr>';

                                str = str + '<td>' + data.table[i].minx + '</td>';
                                str = str + '<td>' + data.table[i].maxx + '</td>';
                                str = str + '<td>' + data.table[i].miny + '</td>';
                                str = str + '<td>' + data.table[i].maxy + '</td>';
                                str = str + '<td>' + data.table[i].price + '</td>';

                                str = str + '</tr>';
                            }

                            profil = data.profil;

                            $('#tablebody').html(str);
                            $('#tit').html('Прайс на глухое окно (без СП) ' + profil);

                        },
                        'json'
                    );
                });

            }
        );


    </script>

</body>

</html>