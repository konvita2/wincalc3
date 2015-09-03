<!DOCTYPE html>
<html>

<head>
    <title>test BootStrap</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/bootstrap.css"/>
    <link rel="stylesheet" href="/css/style.css"/>
    <script src="/js/jquery-2.1.4"></script>
    <script src="/js/bootstrap.js"></script>

</head>

<body>

    <div class="container">

        <h3>Header #3</h3>

        <p aria-hidden="true">Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты. Вдали от всех живут они в буквенных домах на берегу Семантика большого языкового океана. Маленький ручеек Даль журчит по всей стране и обеспечивает ее всеми необходимыми правилами. Эта парадигматическая страна, в которой жаренные члены предложения залетают прямо в рот. Даже всемогущая пунктуация не имеет власти над рыбными текстами, ведущими безорфографичный образ жизни. Однажды одна маленькая строчка рыбного текста по имени Lorem ipsum решила выйти в большой мир грамматики.
        </p>

        <p>
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            Великий Оксмокс предупреждал ее о злых запятых, диких знаках вопроса и коварных точках с запятой, но текст не дал сбить себя с толку. Он собрал семь своих заглавных букв, подпоясал инициал за пояс и пустился в дорогу. Взобравшись на первую вершину курсивных гор, бросил он последний взгляд назад, на силуэт своего родного города Буквоград, на заголовок деревни Алфавит и на подзаголовок своего переулка Строчка. Грустный реторический вопрос скатился по его щеке и он продолжил свой путь. По дороге встретил текст рукопись. Она предупредила его: «В моей стране все переписывается по несколько раз. Единственное, что от меня осталось, это приставка «и». Возвращайся ты лучше в свою безопасную страну». Не послушавшись рукописи, наш текст продолжил свой путь. Вскоре ему повстречался коварный составитель
        </p>

        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            Enter a valid email address
        </div>

        <div>
            <button id="btn0" name="btn0" type="button">Test ajax 01</button>
        </div>

        <div class="panel panel-default">
            <div class="panel-body" id="respanel"></div>
        </div>



    </div>



    <script>
        //test ajax
        $(document).ready(
            $('#btn0').bind('click', function () {
                //alert('del me');

                $.post(
                    '/index.php/test_bs3/ajax1',
                    {
                        par1: "audi",
                        par2: "vw"
                    },
                    function (data) {
                        $('#respanel').html('');

                        var ss = data.car1 + ', ' + data.car2 + '<br/>';
                        for(var i in data.drivers){
                            ss += data.drivers[i] + ', ';
                        }

                        $('#respanel').html(ss);

                    },
                    'json'
                );
            })
        );


    </script>

</body>

</html>

