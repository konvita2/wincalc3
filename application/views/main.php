<?

// главная административная страница
// требуются админ права для открытия

?>

<? $this->load->helper('url'); ?>

<? $this->load->view('main_topmost'); ?>

<!DOCTYPE html>
<html lang="en">

<?
$data['tit'] = 'Настройки';
$this->load->view('main_head', $data);
?>

<body>

<? $this->load->view('main_navbar'); ?>

<div class="container">
        
        <div class="win-header">
            <h1>Оконный калькулятор</h1>            
        </div>       
        
        <div class="row">
            <div class="col-sm-6 win-grid">
                <div class="row">
                    
                    <div class="col-sm-4 win-img">
                        <img src="/img/okn_stvorka1.jpg" height="150px"/>
                    </div>
                    
                    <div class="col-sm-8">
                        <h4>Окно 1 створка</h4>
                        <p class="win-desc">
                        Наши окна это современные и очень удобные светопрозрачные 
                        системы, которые сохраняют тепло помещения в холодное время 
                        года или позволяют выбрать оптимальный режим проветривания 
                        в жаркую погоду. Они неприхотливы в уходе и на долгие годы 
                        сохраняют свой опрятный вид. Установка пластиковых окон 
                        принесет уют в Ваш дом и комфорт в Ваш офис.</p>                        
                        
                        <div><button type="button" class="btn btn-primary">Расчет</button></div>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-sm-6 win-grid">
                <div class="row">
                    
                    <div class="col-sm-4 win-img">
                        <img src="/img/okn_gluh.jpg" height="150px"/>
                    </div>
                    
                    <div class="col-sm-8">
                        <h4>Окно глухое</h4>
                        <p class="win-desc">
                        Наши окна это современные и очень удобные светопрозрачные 
                        системы, которые сохраняют тепло помещения в холодное время 
                        года или позволяют выбрать оптимальный режим проветривания 
                        в жаркую погоду. Они неприхотливы в уходе и на долгие годы 
                        сохраняют свой опрятный вид. Установка пластиковых окон 
                        принесет уют в Ваш дом и комфорт в Ваш офис.</p>                        
                        
                        <div><button type="button" class="btn btn-primary">Расчет</button></div>
                    </div>
                    
                </div>
                
            </div>
        </div>
        
        <div class="row">
            
        </div>
        
        
        
    </div>
    
    

</body>
    
    
    
</html>
