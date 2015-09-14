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
                <button type="button" id="btnCalc" class="btn btn-primary col-sm-2 col-sm-offset-2">Расчитать</button>
            </div>
        </form>

        <!-- results -->

        <div class="panel panel-primary ">

            <div class="panel-heading">
                <h3 class="panel-title">Результат расчета</h3>
            </div>

            <div class="panel-body" id="resultArea">

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
                    $('#debugArea').html('');
                    var inp = data.input; // it's a string
                    $('#debugArea').html(inp);

                    //alert('222');


                    $('#resultArea').html('');
                    var cost = data.cost;
                    var coststr = 'Стоимость изделия:' + cost.toString() + ' грн.';
                    $('#resultArea').html(coststr);
                },
                'json'
            );

        })
    );



</script>


</body>
</html>