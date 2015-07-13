<? $this->load->view('main_topmost'); ?>

<html lang="ru">

<? $this->load->view('main_head'); ?>

<body>

<? $this->load->view('main_navbar'); ?>

<div class="container">

    <h3>
        Стеклопакеты:
        <? if($mode == 'ed'): ?>
            редактирование
        <? elseif($mode == 'dl'): ?>
            удаление
        <? elseif($mode == 'nw'): ?>
            добавление нового
        <? else: ?>
            неизвестная команда
        <? endif ?>
    </h3>

    <? if($mode == 'dl'): ?>
        <div class="alert alert-danger">
            Вы уверены в том что хотите удалить выбранный стеклопакет?
        </div>
    <? endif ?>

    <?

    // test cmd
    if($mode == 'ed' || $mode == 'dl' || $mode == 'nw'){
        $cmdOk = true;
    }
    else{
        $cmdOk = false;
    }

    // test data
    $dataOk = true;
    if($mode == 'ed' || $mode == 'dl'){
        if(empty($glass)){
            $dataOk = false;
        }
    }

    ?>

    <? if($cmdOk && $dataOk): ?>

        <!--
        <form class="form-horizontal">
        -->

        <?
            if($mode == 'ed' || $mode == 'dl'){
                $this->load->helper('form');
                $ar = array('class' => 'form-horizontal',);
                $id = $glass['id'];
                if($mode == 'ed')
                    echo form_open("conf_glass/edit/$id",$ar);
                else
                    echo form_open("conf_glass/del/$id",$ar);
            }
            elseif($mode == 'nw'){
                $this->load->helper('form');
                $ar = array('class' => 'form-horizontal',);
                $id = 0;
                $glass = array(
                    'id' => 0,
                    'nam' => '',
                    'description' => '',
                    'cur_name' => '',
                    'price' => 0,
                );
                echo form_open("conf_glass/add",$ar);
            }

        ?>

        <?

        if($mode == 'dl'){
            $dlmark = 'readonly';
        }
        else{
            $dlmark = '';
        }

        ?>

            <div class="form-group">
                <label for="inputId" class="col-sm-2 control-label">Код</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="inputId" readonly
                           value="<?=$glass['id']?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="inputNam" class="col-sm-2 control-label">Наименование</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="inputNam" name="nam" <?=$dlmark?>
                        value="<?=$glass['nam']?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="inputDesc" class="col-sm-2 control-label">Описание</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputDesc" name="description" <?=$dlmark?>
                           value="<?=$glass['description']?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="inputCurr" class="col-sm-2 control-label">Валюта</label>
                <div class="col-sm-2" >
                    <select class="form-control" name="cur_name" <?=$dlmark?>  >
                        <?=$currency_list?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPrice" class="col-sm-2 control-label">Цена в валюте за кв.м.</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="inputPrice" name="price" <?=$dlmark?>
                           value="<?=$glass['price']?>"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" name="btnSave">
                        <? echo $mode == 'dl' ? 'Удалить' : 'Сохранить' ?>
                    </button>
                    <a type="button" class="btn btn-primary"
                       href="index"
                       name="btnCancel">Отмена</a>
                </div>
            </div>
        </form>

    <? else: ?>

        <!-- error messages -->

    <? endif ?>




</div>
</body>
</html>