<?php

// главная административная страница
// требуются админ права для открытия

?>

<?php $this->load->helper('url'); ?>

<?php $this->load->view('main_topmost'); ?>

<!DOCTYPE html>
<html lang="en">

<?php
$data['tit'] = 'Настройки';
$this->load->view('main_head', $data);
?>

<body>

<?php $this->load->view('main_navbar'); ?>

<div class="container">

    <div class="win-header">
        <h3>Расчет стоимости глухого окна</h3>
    </div>

    <div class="wc3-input-section">
        <form class="form-horizontal">

            <div class="form-group">
                <label for="parW" class="col-sm-2 control-label">Ширина</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" placeholder="Введите ширину" id="parW" name="width"/>
                </div>
            </div>

            <div class="form-group">
                <label for="parH" class="control-label col-sm-2">Высота</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" placeholder="Введите высоту" id="parH" name="height"/>
                </div>
            </div>

            <div class="form-group">
                <label for="profil" class="control-label col-sm-2">Профиль</label>
                <div class="col-sm-4">
                    <?php echo $profil_set; ?>
                </div>
            </div>

            <div class="form-group">
                <label for="glass" class="control-label col-sm-2">Стеклопакет</label>
                <div class="col-sm-4">
                    <?php echo $glass_set; ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" id="btnCalc" class="btn btn-default">Расчитать</button>
                </div>
            </div>
        </form>
    </div>

    <!-- results -->

    <div class="col-sm-8">
        <div class="panel panel-primary ">

            <div class="panel-heading">
                <h3 class="panel-title">Результат расчета</h3>
            </div>

            <div class="panel-body" id="resultArea">

            </div>

        </div>
    </div>

</div>

<script type="text/javascript">

    $(document).ready(
        $('#btnCalc').bind('click', function () {
            //alert('111');

            var w = $('#parW').val();
            var h = $('#parH').val();
            var profil_sym = $('#profil').val();
            var glass_id = $('#glass').val();

            $.post(
                '/index.php/calc/gluhajax',
                {
                    task: 'calc',
                    w: w,
                    h: h,
                    profil_sym: profil_sym,
                    glass_id: glass_id
                },
                function(data){
                    var inp = data.input; // it's a string

                    $('#resultArea').html('');
                    var cost = data.cost;
                    var coststr = '<p style="font-weight: bold;">Стоимость изделия:' + cost.toFixed(2) + ' грн.</p>';
                    $('#resultArea').html(inp + coststr);
                },
                'json'
            );

        })
    );



</script>


</body>
</html>