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
        <h4>Расчет стоимости глухого окна</h4>
    </div>

    <div class="wc3-input-section">
        <form class="form-horizontal">

            <div class="form-group form-group-sm">
                <label for="parW" class="col-sm-2 control-label">Ширина</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" placeholder="Введите ширину" id="parW" name="width"/>
                </div>
            </div>

            <div class="form-group form-group-sm">
                <label for="parH" class="control-label col-sm-2">Высота</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" placeholder="Введите высоту" id="parH" name="height"/>
                </div>
            </div>

            <div class="form-group form-group-sm">
                <label for="profil" class="control-label col-sm-2">Профиль</label>
                <div class="col-sm-4">
                    <?php echo $profil_set; ?>
                </div>
            </div>

            <div class="form-group form-group-sm">
                <label for="glass" class="control-label col-sm-2">Стеклопакет</label>
                <div class="col-sm-4">
                    <?php echo $glass_set; ?>
                </div>
            </div>

            <div class="form-group form-group-sm">
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

        <canvas height="320" width="480" id="mycanvas"></canvas>

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

                    var glass_nam = data.glass_nam;

                    var ww = new GluhWindow(w,h,profil_sym,glass_nam);
                    ww.draw("mycanvas");
                },
                'json'
            );

        })
    );



</script>

<script>

    // constructor
    function GluhWindow(width, height, profil, glass){
        this.width = width;
        this.height = height;
        this.profil = profil;
        this.glass = glass;

        this.draw = function(cntid){
            var cnv = document.getElementById(cntid);
            var cnt = cnv.getContext('2d');

            // delete later
            cnv.width = 330;
            cnv.height = 330;

            //cnt.strokeRect(0,0, 300, 300); // debug

            // define max size
            var ky = this.height / (cnv.height - 50);
            var kx = this.width / (cnv.width - 50);

            var k = Math.max(ky,kx);

            // out rect
            cnt.strokeRect(0,0, this.width / k, this.height / k);
            //cnt.strokeRect(0,0, 100, 200);

            // inner rect 1
            cnt.strokeRect(45 / k, 45 / k, (this.width - 90) / k, (this.height - 90) / k);

            // inner rect 2 (glass)
            cnt.strokeRect(60 / k, 60 / k, (this.width - 120) / k, (this.height - 120) / k);
            cnt.fillStyle = "#82FFE6";
            cnt.fillRect(60 / k + 1, 60 / k + 1, (this.width - 120) / k - 1, (this.height - 120) / k - 1);

            // glass text
            cnt.fillStyle = 'black';
            cnt.font = "12px sans-serif";
            cnt.fillText(this.glass.toString(),60 / k + 5, 60 / k + 17);

            // bottom size line
            cnt.beginPath();
            cnt.moveTo(0, this.height / k + 10);
            cnt.lineTo(0, this.height / k + 22);

            cnt.moveTo(this.width / k, this.height / k + 10);
            cnt.lineTo(this.width / k, this.height / k + 22);

            cnt.moveTo(0, this.height / k + 16);
            cnt.lineTo(this.width / k / 2 - 50, this.height / k + 16);

            cnt.moveTo(this.width / k / 2 + 50, this.height / k + 16);
            cnt.lineTo(this.width / k, this.height / k + 16);

            cnt.stroke();

            // bottom line text
            cnt.fillStyle = 'black';
            cnt.font = "bold 16px sans-serif";
            cnt.fillText(this.width.toString(),this.width / k / 2 - 40,this.height / k + 20);

            // side size line
            cnt.beginPath();

            cnt.moveTo(this.width / k + 10, 0);
            cnt.lineTo(this.width / k + 22, 0);

            cnt.moveTo(this.width / k + 10, this.height / k);
            cnt.lineTo(this.width / k + 22, this.height / k);

            cnt.moveTo(this.width / k + 16, 0);
            cnt.lineTo(this.width / k + 16, this.height / k / 2 - 20);

            cnt.moveTo(this.width / k + 16, this.height / k);
            cnt.lineTo(this.width / k + 16, this.height / k / 2 + 20);

            cnt.stroke();

            // side line text
            cnt.fillStyle = 'black';
            cnt.font = "bold 16px sans-serif";
            cnt.fillText(this.height.toString(), this.width / k + 8, this.height / k / 2 + 12);

            // bottom text
            cnt.fillStyle = 'black';
            cnt.font = "bold 12px sans-serif";
            cnt.fillText("Глухое окно",0,this.height / k + 35);
            cnt.font = "12px sans-serif";
            cnt.fillText("Профиль: " + this.profil, 0, this.height / k + 49);

        }
    }

</script>



</body>
</html>