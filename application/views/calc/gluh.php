<!DOCTYPE html>
<html>

<head>
    <title>Расчет стоимости глухого окна</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/bootstrap.css"/>
    <link rel="stylesheet" href="/css/style.css"/>
    <script src="/js/jquery-2.1.4"></script>
    <script src="/js/bootstrap.js"></script>
</head>

<body>

    <h3>Расчет стоимости глухого окна</h3>

    <label>Ширина</label>
    <input type="number" placeholder="Введите ширину" id="parW" name="width"/>

    <br/>
    <label>Высота</label>
    <input type="number" placeholder="Введите высоту" id="parH" name="height"/>

    </br
    <label>Профиль</label>
    <? echo $profil_set; ?>

    </br
    <label>Стеклопакет</label>
    <? echo $glass_set; ?>

    <div>
        <button type="button" id="btnCalc">Расчитать</button>
    </div>

    <div id="debugArea"></div>

    <div id="resultArea"></div>

    <script type="text/javascript">

        $(document).ready(
            $('#btnCalc').bind('click', function () {
                alert('111');

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
                        inp = data.input; // it's a string
                        $('#debugArea').html(inp);
                    },
                    'json'
                );

            })
        );



    </script>


</body>

</html>