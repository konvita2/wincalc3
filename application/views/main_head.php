<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/bootstrap.css"/>
    <link rel="stylesheet" href="/css/style.css"/>
    <script src="/js/jquery-2.1.4"></script>
    <script src="/js/bootstrap.js"></script>

    <?php

    if(!isset($tit)){
        echo "<title>WinCalc3 - оконный калькулятор</title>";
    }
    else{
        echo '<title>' . $tit . '</title>';
    }

    ?>

</head>